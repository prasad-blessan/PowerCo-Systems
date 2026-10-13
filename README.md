# PowerCo-Systems

WordPress site for **PowerCo Systems**, an industrial power-systems company layout (placeholder content and branding).

## Contents
- WordPress core
- `wp-content/themes/powerco/`: custom theme (header, mega menu, hero, product tiles, testimonial slider, "Own It" section, careers banner, contact, footer)
- `setup/setup.php`: creates all pages and menus, activates the theme and sets the front page

## Local setup (XAMPP)
1. Clone into `C:\xampp\htdocs\wordpress-web` and start Apache + MySQL.
2. Create a database (e.g. `wordpress_db`).
3. Copy `wp-config-sample.php` to `wp-config.php` and set the DB name/user/password and the salts (https://api.wordpress.org/secret-key/1.1/salt/).
4. Open `http://localhost/wordpress-web/` and complete the WordPress install.
5. Create pages and menus:
   ```
   C:\xampp\php\php.exe setup\setup.php C:\xampp\htdocs\wordpress-web
   ```
6. Edit company details in **Appearance → Customize → Company Info**.

> Run `setup.php` only once, on a fresh install. Running it again creates duplicate pages.
