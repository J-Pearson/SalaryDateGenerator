## Documentation for Technical Challenge

For my intepretation of the Technical Challenge for the insurance emporium I have written an CLI (Artisan Command) using my framework of Choice which is Laravel. To run the command, please run php artisan generate:salary-dates. Having ran this, input will be prompted for to provide a period of months to generate dates for. Once this has been provided, it prints to CLI and saves into a csv.

This command abides by any days which are weekends and sets the date to the nearest workday. For the basic payment this would be a Friday, for the Bonus Payment, this typically would be a Monday. Ive also added an additional feature where by I check an array of Holiday dates and if either the Basic Payment Date, or Bonus Date falls on a Holiday, it will find the nearest previous day taking into account weekends and other holiday days.
