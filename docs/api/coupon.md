---
title: Coupon API
---

## Querying

### `all`

The `all` method will return an `array` of [`Entry`](https://github.com/statamic/cms/blob/3.3/src/Entries/Entry.php) objects in the coupons collection.

### `query`

The `query` method will return an [`EntryCollection`](https://github.com/statamic/cms/blob/3.3/src/Entries/EntryCollection.php) of entries in the coupons collection.

### `find`

The `find` method accepts an `$id` parameter (eg. entry ID) and will return an instance of the [Coupon](https://github.com/doublethreedigital/simple-commerce/blob/2.4/src/Coupons/Coupon.php) object.

If no coupon is found with the provided ID, an `EntryNotFound` exception will be thrown.

### `findByCode`

The `findByCode` method accepts a `$code` parameter (eg. coupon code) and will return an instance of the [Coupon](https://github.com/doublethreedigital/simple-commerce/blob/2.4/src/Coupons/Coupon.php) object.

If no coupon is found with the provided code, an `EntryNotFound` exception will be thrown.

### `create`

The `create` method accepts two parameters: a `$data` parameter, which should be an `array` of the data you wish to save & `$site` which should be a `string` of the site you wish to save to (eg. site handle).

This method returns an instance of the [Coupon](https://github.com/doublethreedigital/simple-commerce/blob/2.4/src/Coupons/Coupon.php) object.

## Methods

### `id`

The `id` method returns the ID of the related entry.

### `title`

The `title` method returns the title of the related entry.

### `slug`

The `slug` method returns the slug of the related entry.

### `data`

The `data` method is a special getter/setter method.

If you don't provide any parameters, the `data` method will return a Collection instance, containing the coupon's data.

If you wish, you may pass in an `array` of data.

### `has`

The `has` method accepts a `$key` parameter which should be a `string` of the key you wish to check if it is present in the coupon's data.

### `get`

The `get` method accepts two parameters: a `$key` parameter which should be a `string` of the key you wish to get from the coupon's data. Optionally, you may pass a `$default` parameter as the second parameter which will be returned if no value exists in the coupon's data.

This method will return the value of the item in the coupon's data.

### `set`

The `set` method accepts two parameters: `$key` parameter which should be a `string` of the key you wish to set the item to & a `$value` parameter.

The key/value will be set on the coupon's data.

### `code`

The `code` method returns the coupon's code (a `string`).

### `isValid`

The `isValid` method accepts an `$order` parameter (which should be an `Order` instance). It will return a `boolean`.

### `redeem`

### `isProductSpecific`

### `isCustomerSpecific`

### `blueprint`

### `toResource`

### `toAugmentedArray`

### `toArray`

### `entry`

### `fresh`

### `save`

### `delete`
