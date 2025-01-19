## Todo:

- Setup Prettier
- Basic design
- Create new resource controller php artisan make:controller CouponController --resource
- Validation + error messages
- Create component for alert-messages

## Challenges:

- Prosject setup on multiple computers.

## Future features:

- Add variable for action to append with message, i.e. "Gå til siden for abonnement for å løse inn rabattkoden".
- Mobile first
- Loading states: Loading spinner, Disable input field while loading
- Error states: Display error message below form.
- Livewire
- aria-label, aria-labelledby
- Make sure email input is sanitized if in contact with database
- Use the store-method to log that a user has logged in, and when, then:
- Send en email to a user: "You have been inactive for n days, here are the most popular articles this week"
- Collect and compare data on how often a user uses the service.

### Questions:

- Use custom method instead of store?
- Extract logic to service?
- How to apply Solid principles? How much logic should be in the controller? Can we use a service class to handle the logic? Should the service class have its own sub-functions that return true/false and a message?
- How to handle different kinds of methods with a single form entry? (POST + PUT)
