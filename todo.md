## Todo:

- Setup Prettier
- Basic design
- Create new resource controller php artisan make:controller CouponController --resource
- Validation + error messages
- Create component for alert-messages

## Docs / Readme:

Instruksjoner for hvordan man kjører applikasjonen, inkludert steg for oppsett og avhengigheter.
En kort beskrivelse av valg, antagelser, kompromisser og utfordringer du har møtt på under utviklingen.

## Future features:

- Mobile first
- Loading states: Loading spinner, Disable input field while loading
- aria-label, aria-labelledby
- Make sure email input is sanitized if in contact with database
- Use the store-method to log that a user has logged in, and when, then:
- Send en email to a user: "You have been inactive for n days, here are the most popular articles this week"
- Collect and compare data on how often a user uses the service.

### Questions:

- How to apply Solid principles? How much logic should be in the controller? Can we use a service class to handle the logic? Should the service class have its own sub-functions that return true/false and a message?
- How to handle different kinds of methods with a single form entry? (POST + PUT)
