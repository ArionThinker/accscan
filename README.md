## AccScan

AccScan is a command-line utility developed in PHP for searching user accounts across various online platforms. It allows you to check the presence of user accounts based on a given username on popular platforms such as GitHub, LiveJournal, Freelancehunt, YouTube, and more.

### Installation and Requirements

To use AccScan, you need:

- PHP version 7.0 or higher.
- The cURL module for PHP installed.
- Clone or download a copy of the program's source code repository.

### Usage

To run AccScan, follow these steps:

1. Open a terminal and navigate to the directory where the program files are located.

2. Run the utility, specifying the username and any required flags:

   ```bash
   php accscan.php --search <username>
   ```

   For example:

   ```bash
   php accscan.php --search john_doe
   ```

   The utility will search for the specified username across different resources and display the results in the terminal.

### Flags

AccScan supports the following flags:

- `--search` (`-s`): Indicates that a search for the specified username should be performed.

- `--version` (`-v`): Displays the current version of the program.

### Customization and Configuration

You can extend the functionality of AccScan by adding or modifying resources on which the account search is performed. To do this, modify or add entries to the `$resources` array in the `resources.php` file, specifying the URL template and the variable to replace `{{username}}` accordingly.

### License

AccScan is distributed under the MIT License. For more information, see the `LICENSE` file.

### Authors

AccScan is developed and maintained by the following authors:

- Andrii Riabchenko (github.com/ArionThinker)

If you have any questions, issues, or suggestions, please create an issue on the GitHub repository. We are happy to assist you.

### Acknowledgements

We would like to thank the following projects and communities for their open-source contributions and inspiration.

