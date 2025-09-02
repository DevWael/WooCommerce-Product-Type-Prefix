# WooCommerce Product Type Prefix

A WordPress plugin that enhances the WooCommerce admin experience by displaying product types as prefixes to product names in the admin product list.

## Description

The WooCommerce Product Type Prefix plugin automatically adds product type labels (Simple, Variable, Grouped, External, etc.) as visual prefixes to product names in the WooCommerce admin product list. This makes it easier for store administrators to quickly identify product types at a glance without having to open individual product pages.

## Features

- **Visual Product Type Identification**: Displays product type as a styled prefix before product names
- **Admin List Enhancement**: Works in the main WooCommerce products admin list
- **Automatic Detection**: Automatically detects and displays all WooCommerce product types
- **Clean Integration**: Seamlessly integrates with existing WooCommerce admin interface
- **Translation Ready**: Includes text domain support for internationalization
- **WooCommerce Dependency Check**: Automatically detects if WooCommerce is active

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- PHP 7.4 or higher

## Installation

### Method 1: Manual Installation

1. Download the plugin files
2. Upload the `wc-product-type-prefix` folder to your `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Ensure WooCommerce is installed and activated

### Method 2: WordPress Admin

1. Go to Plugins > Add New
2. Click "Upload Plugin"
3. Choose the plugin zip file
4. Click "Install Now"
5. Activate the plugin

## Usage

Once activated, the plugin automatically:

1. **Modifies the Product List**: Changes the "Product Name" column header to "Product Name (Type)"
2. **Adds Type Prefixes**: Displays product types as styled prefixes before each product name
3. **Enhances Visibility**: Makes it easy to identify product types at a glance

### Example Output

In the admin product list, you'll see:
- `[Simple] Product Name`
- `[Variable] Product Name`
- `[Grouped] Product Name`
- `[External] Product Name`

## Screenshots

The plugin enhances the WooCommerce admin product list by adding product type prefixes to make product identification easier and more efficient.

## Development

### File Structure

```
wc-product-type-prefix/
├── wc-product-type-prefix.php    # Main plugin file
├── README.md                     # This file
├── assets/                       # CSS and JS assets (planned)
│   └── css/
│       └── admin.css
└── languages/                    # Translation files
```

### Code Structure

The plugin follows WordPress coding standards and best practices:

- **Singleton Pattern**: Uses singleton pattern for plugin instance management
- **Proper Hooks**: Utilizes WordPress hooks and filters appropriately
- **Security**: Implements proper escaping and validation
- **Namespacing**: Uses PHP namespaces for code organization
- **Type Declarations**: Implements strict typing for better code quality

### Key Classes and Methods

- `WC_Product_Type_Prefix`: Main plugin class
- `get_instance()`: Singleton instance getter
- `init()`: Plugin initialization
- `modify_product_columns()`: Modifies admin columns
- `render_product_name_column()`: Renders product name with type prefix
- `get_product_type_label()`: Gets formatted product type label

### Hooks and Filters

- `manage_edit-product_columns`: Modifies product list columns
- `manage_product_posts_custom_column`: Renders custom column content
- `plugins_loaded`: Plugin initialization hook

## Customization

### Styling

The plugin includes CSS classes that can be customized:
- Product type prefixes use `<code>` tags for styling
- CSS can be overridden in your theme's admin styles

### Translation

The plugin is translation-ready with the text domain `wc-product-type-prefix`. Translation files should be placed in the `/languages/` directory.

## Troubleshooting

### Common Issues

1. **Product types not showing**: Ensure WooCommerce is active and you're viewing the products admin list
2. **Plugin not working**: Check that WooCommerce is properly installed and activated
3. **Styling issues**: Verify that the admin CSS is loading correctly

### Debug Mode

Enable WordPress debug mode to see any potential errors:
```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
```

## Changelog

### Version 1.0.0
- Initial release
- Basic product type prefix functionality
- Admin column modification
- WooCommerce dependency checking