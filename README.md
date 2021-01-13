# Salsa Demo
Repository containing code, project and readme for the Salsa API Demo form

## Scenario C
The client uses an external system to collect user information as this data cannot be stored in a web accessible database.
You need to build a form that can accept user input and submit this directly to the external system via the REST API.

The form needs to accept the following fields:
* First name
* Last name
* Email address

### Response
I have created a form that accepts these three fields and on submit sends those to a dummy api client.
A simple form like this is easiest to implement as a custom form, there are modules that can make form creation easier
but for this usecase they're both overkill and not fit for purpose.

Form implementation: `\Drupal\salsa_api\ApiClient`

## Stub API Details
* Only accepts POST requests
* POST requests need to be authenticated using a bearer token
* The API accepts content-type: application/json
* The API expects the following fields
  * first_name
  * last_name
  * email

A development API endpoint is not available for this scenario, you should present a solution that can submit to a fake URL as an example.

### Response
For this demonstration purpose I have created a dummy api client class. It would have been possible to implement a dummy api itself that actually
accepted the post data, checked the api key etc, however it seemed overkill for this simple demo.

Additionally I have included a settings form that can in turn store the API url in configuration.

The demo client exposes a postUserData method which in turn looks up the URL from drupal configuration and performs a fake post request. 
Rather than spend the time required to deal with creating and authenticating against an API that I can't test against, I have added comments and to methods such as `\Drupal\salsa_api\ApiClient::getToken`

Settings form: `\Drupal\salsa_api_form\Form\SettingsForm`
API Dummy client: `\Drupal\salsa_api\ApiClient`
