# Jules' Dealer Locator

A WordPress plugin for a dealer locator with Elementor integration.

## Description

This plugin allows you to add a dealer locator to your WordPress website. You can add dealers with their contact information, and display them on a map with a filterable list. The plugin also includes an Elementor widget for easy integration with the Elementor page builder.

## Installation

1.  Upload the `jules-dealer-locator` directory to the `/wp-content/plugins/` directory.
2.  Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

### Creating Dealers

1.  After activating the plugin, you will see a new "Dealers" menu item in the WordPress admin area.
2.  Click on "Dealers" -> "Add New" to create a new dealer.
3.  Enter the dealer's name in the title field.
4.  Enter a description of the dealer in the content editor.
5.  In the "Dealer Details" meta box, enter the dealer's address, phone number, website, latitude, and longitude.
6.  Set a dealer logo by using the "Featured Image" meta box.
7.  Click "Publish" to save the dealer.

### Displaying the Dealer Locator

You can display the dealer locator on any page or post using a shortcode or the Elementor widget.

#### Shortcode

To display the dealer locator, use the following shortcode:

`[jules_dealer_locator]`

This will display the dealer locator with a map and a filterable list of dealers.

#### Elementor Widget

If you are using the Elementor page builder, you can use the "Jules Dealer Locator" widget to display the dealer locator.

1.  Edit a page with Elementor.
2.  In the widgets panel, search for "Jules Dealer Locator".
3.  Drag and drop the widget into your page.
4.  You can customize the title of the widget in the widget's settings.

### Dealer Login

The plugin includes a simple dealer login portal. You can display a login form using the following shortcode:

`[jules_dealer_login_form]`

When a user with the "Dealer" role logs in, they will be redirected to the WordPress admin area, where they can manage their own dealer posts.
