# Group 12 - Technical rules.
For all collabolators of this project, please follow these rules.

### 1. Gihtub
Always commit meaningful signed commit messages.
```bash
git commit -S -m "your message"
```
Create a new branch for each new feature.
```bash
git checkout -b "your-branch-name"
```
Never push directly to the main branch.
```bash
git push -f origin "your-branch-name"
```

### 2. Code
Code in english ?
Always use camelCase for variables and functions.
```php
$myMessage = "Hello World";

function myFunction() {
    // ...
}
```
Always use PascalCase for classes.
```php
class MyClass {
    // ...
}
```