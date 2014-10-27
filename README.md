JsConnect tester
----------------

A simple vanilla jsConnect testing page.
It allows you to set the different parameters during login that will then be presented to vanilla forums.

Why?
===

I needed to test some combinations of missing username/email when I was setting up federate SAML login.
And after runing into a nasty little "security hole" when e.g. you don't get an email in the SAML response, and have turned on `AutoConnect`, then the user get to specify which email to use.
This email address is then not checked, but just blindly accepted, making it possible to hijack an account if you know the account email (and have access to an accepted federate login without email).

Usage
=====

You can just use it directlt in your vanilla forums folder and use the jsConnect client id `jsconnect-test`, secret `99bottlesofbeer`, hash algorithm `sha256`.

Quick note on unique id: It us used by jsconnect to identify which user this jsconnect connects to.
This means that if you use the same unique id, but change the info, then you can test the `ConnectSynchronize` option.
If you change the unique id, but use e.g. the same email then you can test what happens when two users have the same email address.

JsConnect tester will use `PHPSESSION` to persist the data between requests, which allows you to change the data. 
However when you log out of vanilla forums the session will be destroyed, which means that if you run the jsconnect-test service on the same instance of php as vanilla forums it will not remember your data.
It is not really that big of a deal, but relevant none the less.
