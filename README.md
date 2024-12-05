# VulnSearch

VulnSearch is a Vulnerability Search website that can search vulnerabilities from credible sources like CVE & Exploit DB.

VulnSearch provide users with a search system to look for vulnerabilities in CVE & Exploit DB in a card-like presentation called Vulnerability Card.

**Vulnerability Card**: Search results shows as Vulnerability Cards with each card showing the colour of the Severity Level.
**Bookmark**: A bookmark feature for users to bookmark Vulnerability Cards so users can look at the bookmarked Vulnerability Cards.
**Simple to Use**: Our website provides simple steps to instantly look for vulnerabilites related.

## Installation
### Requirement
- PHP version ^8.3
- Apache ^2.4.62
- MySQL ^8.0
- Composer installed

1. Clone the project using git clone.
```bash
git clone https://github.com/jayjOnly/VulnSearch.git
```
2. Run composer install to install the the package required.

```bash
composer install
```
3. Copy the .env.example into .env
```bash
cp .env.example .env
```
Or
```bash
copy .env.example .env
```
4. Generate app key
```bash
php artisan key:generate
```
5. Migrate the database
```bash
php artisan migrate
```
6. Install npm
```bash
npm install
```
7. Run the npm using
```bash
npm run dev
```
8. Running the application
```bash
php artisan serve
```

# Authors
- [@jayjOnly](https://github.com/jayjOnly) (Andrew)
- [@Ren9x](https://github.com/Ren9x) (Udin)
- [@sethyrical](https://github.com/sethyrical) (Anjori)
- [@MoriFer](https://github.com/MoriFer) (Fernando)
- [@Panduaji18](https://github.com/Panduaji18) (Pandu)
