<?php

namespace Damcclean\Commerce\Models;

use Illuminate\Filesystem\Filesystem;
use Statamic\Yaml\Yaml;

class BaseModel
{
    protected $name;
    protected $slug;
    protected $route;

    public function __construct()
    {
        $this->yaml = new Yaml();
        $this->filesystem = new Filesystem();

        $this->path = base_path().'/content/commerce/'.$this->slug;

        if (! file_exists($this->path)) {
            (new Filesystem())->makeDirectory($this->path, 0755, true, true);
        }
    }

    public function attributes($file)
    {
        $attributes = $this->yaml->parse(file_get_contents($file));
        $attributes['edit_url'] = $this->editRoute($attributes['slug']);
        $attributes['delete_url'] = $this->deleteRoute($attributes['slug']);

        return $attributes;
    }

    public function all()
    {
        $items = glob(
            $this->path.'/*.md',
            GLOB_BRACE
        );

        return collect($items)
            ->map(function ($item) {
                return $this->attributes($item);
            });
    }

    public function get(string $slug)
    {
        $path = $this->path.'/'.$slug.'.md';

        return json_decode(collect($this->attributes($path))->toJson());
    }

    public function search($query)
    {
        $everything = $this->all();

        if (! $query) {
            return $everything;
        }

        return $everything
            ->filter(function ($item) use ($query) {
                return false !== stristr($item['title'], $query);
            });
    }

    public function save(string $slug, array $data)
    {
        $contents = $this->yaml->dumpFrontMatter($data, null);

        file_put_contents($this->path.'/'.$slug.'.md', $contents);

        return collect($data);
    }

    public function update(string $slug, array $data)
    {
        $contents = $this->yaml->dumpFrontMatter($data, null);

        file_get_contents($this->path.'/'.$slug.'.md', $contents);

        if ($data['slug'] != $slug) {
            $this->filesystem->move($this->path.'/'.$slug.'.md', $this->path.'/'.$data['slug'].'.md');
        }

        return collect($data);
    }

    public function delete($slug)
    {
        return $this->filesystem->delete($this->path.'/'.$slug.'.md');
    }

    public function editRoute($slug)
    {
        return cp_route("$this->route.edit", [
            "$this->slug" => $slug
        ]);
    }

    public function deleteRoute($slug)
    {
        return cp_route("$this->route.destroy", [
            "$this->slug" => $slug
        ]);
    }
}
