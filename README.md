# Color Accessibility Checker - WordPress Plugin

A WordPress plugin that helps you check color contrast ratios for accessibility compliance. This tool allows you to test multiple color combinations against WCAG guidelines.

## 🔍 Features

- Test multiple text colors against multiple background colors simultaneously
- WCAG 2.1 compliance checking
- Visual contrast display
- Easy-to-use color picker interface
- Results showing exact contrast ratios
- WCAG level indicators (AAA, AA, AA Large Text, or Fail)

## ⚡ Requirements

- WordPress 5.2 or higher
- PHP 7.2 or higher
- [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/pro/) (ACF PRO) plugin

## 📦 Installation

1. Download the plugin from this repository
2. Upload the plugin files to your `/wp-content/plugins/color-accessibility-checker` directory
3. Make sure ACF PRO is installed and activated
4. Activate the Color Accessibility Checker plugin through the 'Plugins' menu in WordPress

## 🚀 Getting Started

1. Create a new page in WordPress (Pages > Add New)
2. In the Page Attributes panel (right sidebar), select "Color Accessibility Checker" template
3. Publish the page
4. Go to the WordPress admin menu and click on "Color Accessibility"
5. Add your text colors (these will be checked against all background colors)
6. Add your background colors
7. Visit your published page to see the contrast analysis for all color combinations

## 🎨 How It Works

The plugin tests each text color against each background color and provides:
- The exact contrast ratio
- WCAG compliance level
- Visual representation of the color combination
- Pass/Fail status for different WCAG criteria

### WCAG Compliance Levels:
- **AAA**: Contrast ratio ≥ 7:1
- **AA**: Contrast ratio ≥ 4.5:1
- **AA Large Text**: Contrast ratio ≥ 3:1
- **Fail**: Contrast ratio < 3:1

## 📝 License

This project is licensed under the GPL v2 or later - see the [LICENSE](LICENSE) file for details.

## 👥 Author

**Joan Fernandez**
- Website: [joanfernandez.com](https://joan909fernandez.com)
- Github: [@Papamundodev](https://github.com/Papamundodev)


