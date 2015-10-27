# How to contribute
We welcome all contributions to WurmUnlimitedAdmin (WUA). It can be both fixes for bugs, typos or even features that extend this software.

The basic workflow when making contributinos is the following:
- [Fork](https://github.com/PrabhdeepSingh/WurmUnlimitedAdmin/fork) this repository
- Commit your changes
- Make a [pull request](https://help.github.com/articles/using-pull-requests) to `master` branch.

Once you have made a pull request we will review the changes you made and if everything is fine and we like the change the contribution will be pulled into `master` branch. If there are issues with the code or we disagree with how it's been implemented we will describe the issues in the comments so they can be corrected.

## Source code
The following is an overview of how the source code is structure to give contributors an idea of where to look when making changes.

## Code style
These are the guide lines to keep in mind when making code contributions. The code must adhere to the general code style used.

- Code should be properly indented. We use tab-size: two(2) on sublime text. Tab-size two(2) is a two-space indentation and it is used through out the html, css, js and php.
- Separate binary operators with spaces: `$x = 1+1` is incorrect, it should be written as: `$x = 1 + 1`.
- `if`, `while`, `for`, etc, should NOT be separated from the parenthesis. `if ()` is incorrect, it should be written as: `if()`.
- Use single quotes for strings in JavaScript and double quote for attributes in HTML and strings in PHP.