<?php

use App\Entities\Company;
use App\Entities\Coordinator;
use App\Entities\Country;
use App\Entities\Ebook;
use App\Entities\Group;
use App\Entities\LeadershipTeam;
use App\Entities\MpesaIncoming;
use App\Entities\MpesaPaybill;
use App\Entities\Quote;
use App\Entities\SmsOutbox;
use App\Entities\State;
use App\Entities\StateRepresentative;
use App\Entities\UssdEvent;
use App\Permission;
use App\Role;
use App\User;

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});


/******** SMS OUTBOX ROUTES ********/

// Home > SMS outbox
Breadcrumbs::register('smsoutbox', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Sms Outbox', route('smsoutbox.index'));
});

// Home > SMS outbox > Create New SMS
Breadcrumbs::register('smsoutbox.create', function($breadcrumbs)
{
    $breadcrumbs->parent('smsoutbox');
    $breadcrumbs->push('Create New SMS', route('smsoutbox.create'));
});

// Home > SMS outbox > Show SMS
Breadcrumbs::register('smsoutbox.show', function($breadcrumbs, $id)
{
    $smsoutbox = SmsOutbox::findOrFail($id);
    $breadcrumbs->parent('smsoutbox');
    $breadcrumbs->push($smsoutbox->id, route('smsoutbox.show', $smsoutbox->id));
});

/******** SMS OUTBOX ROUTES ********/


/******** GROUPS ROUTES ********/

// Home > Groups
Breadcrumbs::register('groups', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Groups', route('groups.index'));
});

// Home > Groups > Create New Group
Breadcrumbs::register('groups.create', function($breadcrumbs)
{
    $breadcrumbs->parent('groups');
    $breadcrumbs->push('Create New Group', route('groups.create'));
});

// Home > Groups > Show Group
Breadcrumbs::register('groups.show', function($breadcrumbs, $id)
{
    $group = Group::findOrFail($id);
    $breadcrumbs->parent('groups');
    $breadcrumbs->push($group->name, route('groups.show', $group->id));
});

// Home > Groups > Edit Group
Breadcrumbs::register('groups.edit', function($breadcrumbs, $id)
{
    $group = Group::findOrFail($id);
    $breadcrumbs->parent('groups');
    $breadcrumbs->push("Edit group - " . $group->name, route('groups.edit', $group->id));
});

/******** END GROUPS ROUTES ********/


/******** COUNTRIES ROUTES ********/

// Home > Countries
Breadcrumbs::register('countries', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Countries', route('countries.index'));
});

// Home > Countries > Create New Country
Breadcrumbs::register('countries.create', function($breadcrumbs)
{
    $breadcrumbs->parent('countries');
    $breadcrumbs->push('Add New Country', route('countries.create'));
});

// Home > Countries > Show Country
Breadcrumbs::register('countries.show', function($breadcrumbs, $id)
{
    $country = Country::findOrFail($id);
    $breadcrumbs->parent('countries');
    $breadcrumbs->push($country->name, route('countries.show', $country->id));
});

// Home > Countries > Edit Country
Breadcrumbs::register('countries.edit', function($breadcrumbs, $id)
{
    $country = Country::findOrFail($id);
    $breadcrumbs->parent('countries');
    $breadcrumbs->push("Edit Country - " . $country->name, route('countries.edit', $country->id));
});

/******** END COUNTRIES ROUTES ********/



/******** STATES ROUTES ********/

// Home > States
Breadcrumbs::register('states', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('States', route('states.index'));
});

// Home > States > Create State
Breadcrumbs::register('states.create', function($breadcrumbs)
{
    $breadcrumbs->parent('states');
    $breadcrumbs->push('Add New State', route('states.create'));
});

// Home > States > Show State
Breadcrumbs::register('states.show', function($breadcrumbs, $id)
{
    $state = State::findOrFail($id);
    $breadcrumbs->parent('states');
    $breadcrumbs->push("Showing State - " . $state->name, route('states.show', $state->id));
});

// Home > States > Edit State
Breadcrumbs::register('states.edit', function($breadcrumbs, $id)
{
    $state = State::findOrFail($id);
    $breadcrumbs->parent('states');
    $breadcrumbs->push("Edit State - " . $state->name, route('states.edit', $state->id));
});

/******** END STATES ROUTES ********/



/******** MPESA INCOMING ROUTES ********/

// Home > Mpesa Incoming
Breadcrumbs::register('mpesa-incoming', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Mpesa Incoming', route('mpesa-incoming.index'));
});

// Home > Mpesa Incoming > Create Mpesa Incoming
Breadcrumbs::register('mpesa-incoming.create', function($breadcrumbs)
{
    $breadcrumbs->parent('mpesa-incoming');
    $breadcrumbs->push('Create Mpesa Incoming', route('mpesa-incoming.create'));
});

// Home > Mpesa incoming > Show Mpesa Incoming
Breadcrumbs::register('mpesa-incoming.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('mpesa-incoming');
    $breadcrumbs->push("Showing Mpesa Incoming - " . $id, route('mpesa-incoming.show', $id));
});

// Home > Mpesa incoming > Edit Mpesa Incoming
Breadcrumbs::register('mpesa-incoming.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('mpesa-incoming');
    $breadcrumbs->push("Edit Mpesa Incoming - " . $id, route('mpesa-incoming.edit', $id));
});

/******** END MPESA INCOMING ROUTES ********/



/******** MANAGE PRODUCTS ROUTES ********/

// Home > Product
Breadcrumbs::register('products', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Products', route('products.index'));
});

// Home > Product > Create Product - step 1
Breadcrumbs::register('products.create', function($breadcrumbs)
{
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Create Product', route('products.create'));
});

// Home > Product > Show Product
Breadcrumbs::register('products.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('products');
    $breadcrumbs->push("Showing Product - " . $id, route('products.show', $id));
});

// Home > Product > Edit Product
Breadcrumbs::register('products.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('products');
    $breadcrumbs->push("Edit Product - " . $id, route('products.edit', $id));
});

/******** END MANAGE PRODUCTS ROUTES ********/


/******** MANAGE EVENTS ROUTES ********/

// Home > Event
Breadcrumbs::register('events', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('events', route('events.index'));
});

// Home > Event > Create Event - step 1
Breadcrumbs::register('events.create', function($breadcrumbs)
{
    $breadcrumbs->parent('events');
    $breadcrumbs->push('Create Event', route('events.create'));
});

// Home > Event > Show Event
Breadcrumbs::register('events.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('events');
    $breadcrumbs->push("Showing Event - " . $id, route('events.show', $id));
});

// Home > Event > Edit Event
Breadcrumbs::register('events.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('events');
    $breadcrumbs->push("Edit Event - " . $id, route('events.edit', $id));
});

/******** END MANAGE EVENTS ROUTES ********/



/******** LOAN APPLICATION ROUTES ********/

// Home > Loan Application
Breadcrumbs::register('loan-applications', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Loan Applications', route('loan-applications.index'));
});

// Home > Loan Application > Create Loan Application - step 1
Breadcrumbs::register('loan-applications.create', function($breadcrumbs)
{
    $breadcrumbs->parent('loan-applications');
    $breadcrumbs->push('Create Loan Application', route('loan-applications.create'));
});

// Home > Loan Application > Create Loan Application - step 2
Breadcrumbs::register('loan-applications.create_step2', function($breadcrumbs)
{
    $breadcrumbs->parent('loan-applications.create');
    $breadcrumbs->push('Create Loan Application - Step 2', route('loan-applications.create_step2'));
});

// Home > Loan Application > Approve Loan Application
Breadcrumbs::register('loan-applications.approve', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('loan-applications');
    $breadcrumbs->push('Approve Loan Application - ' . $id, route('loan-applications.approve', $id));
});

// Home > Loan Application > Show Loan Application
Breadcrumbs::register('loan-applications.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('loan-applications');
    $breadcrumbs->push("Showing Loan Application - " . $id, route('loan-applications.show', $id));
});

// Home > Loan Application > Edit Loan Application
Breadcrumbs::register('loan-applications.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('loan-applications');
    $breadcrumbs->push("Edit Loan Application - " . $id, route('loan-applications.edit', $id));
});

/******** END LOAN APPLICATION ROUTES ********/



/******** GLOBAL ALTARS ROUTES ********/

// Home > Global Altars
Breadcrumbs::register('global-altars', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Global Altars', route('global-altars.index'));
});

// Home >  Create Global Altars
Breadcrumbs::register('global-altars.create', function($breadcrumbs)
{
    $breadcrumbs->parent('global-altars');
    $breadcrumbs->push('Add New Global Altar', route('global-altars.create'));
});

// Home > Global Altars > Show Global Altar
Breadcrumbs::register('global-altars.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('global-altars');
    $breadcrumbs->push("Showing Global Altar - " . $id, route('global-altars.show', $id));
});

// Home > Global Altars > Edit Global Altar
Breadcrumbs::register('global-altars.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('global-altars');
    $breadcrumbs->push("Edit Global Altar - " . $id, route('global-altars.edit', $id));
});

/******** END GLOBAL ALTARS  ROUTES ********/



/******** PRAYER POINT ROUTES ********/

// Home > Prayer Points
Breadcrumbs::register('prayer-points', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Prayer Points', route('prayer-points.index'));
});

// Home >  Create Prayer Points
Breadcrumbs::register('prayer-points.create', function($breadcrumbs)
{
    $breadcrumbs->parent('prayer-points');
    $breadcrumbs->push('Add New Prayer Point', route('prayer-points.create'));
});

// Home > Prayer Points > Show Prayer Point
Breadcrumbs::register('prayer-points.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('prayer-points');
    $breadcrumbs->push("Showing Prayer Point - " . $id, route('prayer-points.show', $id));
});

// Home > Prayer Points > Edit Prayer Point
Breadcrumbs::register('prayer-points.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('prayer-points');
    $breadcrumbs->push("Edit Prayer Point - " . $id, route('prayer-points.edit', $id));
});

/******** END PRAYER POINT  ROUTES ********/




/******** PRAYER REQUEST ROUTES ********/

// Home > Prayer Requests
Breadcrumbs::register('prayer-requests', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Prayer Requests', route('prayer-requests.index'));
});

// Home > Create Prayer Requests
Breadcrumbs::register('prayer-requests.create', function($breadcrumbs)
{
    $breadcrumbs->parent('prayer-requests');
    $breadcrumbs->push('Add New Prayer Request', route('prayer-requests.create'));
});

// Home > Prayer Requests > Show Prayer Request
Breadcrumbs::register('prayer-requests.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('prayer-requests');
    $breadcrumbs->push("Showing Prayer Request - " . $id, route('prayer-requests.show', $id));
});

// Home > Prayer Requests > Edit Prayer Request
Breadcrumbs::register('prayer-requests.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('prayer-requests');
    $breadcrumbs->push("Edit Prayer Request - " . $id, route('prayer-requests.edit', $id));
});

/******** END PRAYER REQUEST  ROUTES *********/



/******** LEADERSHIP TEAMS ROUTES ********/

// Home > Leadership Teams
Breadcrumbs::register('leadership-teams', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Leadership Team Members', route('leadership-teams.index'));
});

// Home > Create Leadership Teams
Breadcrumbs::register('leadership-teams.create', function($breadcrumbs)
{
    $breadcrumbs->parent('leadership-teams');
    $breadcrumbs->push('Add New Leadership Team Member', route('leadership-teams.create'));
});

// Home > Leadership Teams > Show Leadership Team
Breadcrumbs::register('leadership-teams.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('leadership-teams');
    $name_data = LeadershipTeam::find($id);
    $full_names = $name_data->first_name . ' ' . $name_data->last_name;
    $breadcrumbs->push("Showing Leadership Team Member - " . $full_names, route('leadership-teams.show', $id));
});

// Home > Leadership Teams > Edit Leadership Team
Breadcrumbs::register('leadership-teams.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('leadership-teams');
    $name_data = LeadershipTeam::find($id);
    $full_names = $name_data->first_name . ' ' . $name_data->last_name;
    $breadcrumbs->push("Edit Leadership Team Member - " . $full_names, route('leadership-teams.edit', $id));
});

/******** END LEADERSHIP TEAMS  ROUTES *********/



/******** COORDINATORS ROUTES ********/

// Home > Coordinators
Breadcrumbs::register('coordinators', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Coordinators', route('coordinators.index'));
});

// Home > Create Coordinators
Breadcrumbs::register('coordinators.create', function($breadcrumbs)
{
    $breadcrumbs->parent('coordinators');
    $breadcrumbs->push('Add New Coordinator', route('coordinators.create'));
});

// Home > Coordinators > Show Coordinator
Breadcrumbs::register('coordinators.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('coordinators');
    $name_data = Coordinator::find($id);
    $full_names = $name_data->first_name . ' ' . $name_data->last_name;
    $breadcrumbs->push("Showing Coordinator - " . $full_names, route('coordinators.show', $id));
});

// Home > Coordinators > Edit Coordinator
Breadcrumbs::register('coordinators.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('coordinators');
    $name_data = Coordinator::find($id);
    $full_names = $name_data->first_name . ' ' . $name_data->last_name;
    $breadcrumbs->push("Edit Coordinator - " . $full_names, route('coordinators.edit', $id));
});

/******** END COORDINATORS ROUTES *********/


/******** STATE REPRESENTATIVES ROUTES ********/

// Home > State Representatives
Breadcrumbs::register('state-representatives', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('state-representatives', route('state-representatives.index'));
});

// Home > Create state representative
Breadcrumbs::register('state-representatives.create', function($breadcrumbs)
{
    $breadcrumbs->parent('state-representatives');
    $breadcrumbs->push('Add New State Representative', route('state-representatives.create'));
});

// Home > state-representatives > Show State Representative
Breadcrumbs::register('state-representatives.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('state-representatives');
    $name_data = StateRepresentative::find($id);
    $full_names = $name_data->first_name . ' ' . $name_data->last_name;
    $breadcrumbs->push("Showing State Representative - " . $full_names, route('state-representatives.show', $id));
});

// Home > state-representatives > Edit State Representative
Breadcrumbs::register('state-representatives.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('state-representatives');
    $name_data = StateRepresentative::find($id);
    $full_names = $name_data->first_name . ' ' . $name_data->last_name;
    $breadcrumbs->push("Edit State Representative - " . $full_names, route('state-representatives.edit', $id));
});

/******** END STATE REPRESENTATIVES ROUTES *********/




/******** EBOOKS ROUTES ********/

// Home > Ebooks
Breadcrumbs::register('ebooks', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ebooks ', route('ebooks.index'));
});

// Home > Create Ebook
Breadcrumbs::register('ebooks.create', function($breadcrumbs)
{
    $breadcrumbs->parent('ebooks');
    $breadcrumbs->push('Add New Ebook ', route('ebooks.create'));
});

// Home > Ebooks > Show Ebook
Breadcrumbs::register('ebooks.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ebooks');
    $ebook_data = Ebook::find($id);
    $title = $ebook_data->title;
    $breadcrumbs->push("Showing Ebook - " . $title, route('ebooks.show', $id));
});

// Home > Ebooks > Edit Ebook
Breadcrumbs::register('ebooks.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ebooks');
    $ebook_data = Ebook::find($id);
    $title = $ebook_data->title;
    $breadcrumbs->push("Edit Ebook - " . $title, route('ebooks.edit', $id));
});

/******** END EBOOKS  ROUTES *********/




/******** QUOTES ROUTES ********/

// Home > Quotes
Breadcrumbs::register('quotes', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Quotes ', route('quotes.index'));
});

// Home > Create Quote
Breadcrumbs::register('quotes.create', function($breadcrumbs)
{
    $breadcrumbs->parent('quotes');
    $breadcrumbs->push('Add New Quote ', route('quotes.create'));
});

// Home > Quotes > Show Quote
Breadcrumbs::register('quotes.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('quotes');
    $breadcrumbs->push("Showing Quote - " . $id, route('quotes.show', $id));
});

// Home > Quotes > Edit Quote
Breadcrumbs::register('quotes.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('quotes');
    $breadcrumbs->push("Edit Quote - " . $id, route('quotes.edit', $id));
});

/******** END QUOTES  ROUTES *********/




/******** USER LOAN REPAYMENT ACCOUNTS ROUTES ********/

// Home > User Loan Repayment Accounts
Breadcrumbs::register('user-loan-repayments-accounts', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User Loan Repayment Accounts', route('user-loan-repayments-accounts.index'));
});

// Home > User Loan Repayment Account > Create User Loan Repayment Accounts
Breadcrumbs::register('user-loan-repayments-accounts.create', function($breadcrumbs)
{
    $breadcrumbs->parent('user-loan-repayments-accounts');
    $breadcrumbs->push('Create Account', route('user-loan-repayments-accounts.create'));
});

// Home > User Loan Repayment Account > Show User Loan Repayment Account
Breadcrumbs::register('user-loan-repayments-accounts.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('user-loan-repayments-accounts');
    $breadcrumbs->push("Showing Account - " . $id, route('user-loan-repayments-accounts.show', $id));
});

// Home > User Loan Repayment Account > Edit User Loan Repayment Account
Breadcrumbs::register('user-loan-repayments-accounts.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('user-loan-repayments-accounts');
    $breadcrumbs->push("Edit User Loan Repayment Account - " . $id, route('user-loan-repayments-accounts.edit', $id));
});

/******** END USER LOAN REPAYMENT  ROUTES ********/



/******** SAVINGS DEPOSIT ACCOUNTS ROUTES ********/

// Home > Savings Deposit Accounts
Breadcrumbs::register('savings-deposit-accounts', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Savings Deposit Accounts', route('savings-deposit-accounts.index'));
});

// Home > Savings Deposit Account > Create Savings Deposit Account
Breadcrumbs::register('savings-deposit-accounts.create', function($breadcrumbs)
{
    $breadcrumbs->parent('savings-deposit-accounts');
    $breadcrumbs->push('Create Savings Deposit Account', route('savings-deposit-accounts.create'));
});

// Home > Savings Deposit Account > Show Savings Deposit Account
Breadcrumbs::register('savings-deposit-accounts.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('savings-deposit-accounts');
    $breadcrumbs->push("Showing Account - " . $id, route('savings-deposit-accounts.show', $id));
});

// Home > Savings Deposit Account > Edit Savings Deposit Account
Breadcrumbs::register('savings-deposit-accounts.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('savings-deposit-accounts');
    $breadcrumbs->push("Edit Savings Deposit Account - " . $id, route('savings-deposit-accounts.edit', $id));
});

/******** END SAVINGS DEPOSIT ACCOUNTS ROUTES ********/



/******** LOAN REPAYMENTS DEPOSIT ACCOUNTS ROUTES ********/

// Home > Loan Repayments Deposit Accounts
Breadcrumbs::register('loan-repayments-deposit-accounts', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Loan Repayments Deposit Accounts', route('loan-repayments-deposit-accounts.index'));
});

// Home > Loan Repayments Deposit Account > Create Loan Repayments Deposit Account
Breadcrumbs::register('loan-repayments-deposit-accounts.create', function($breadcrumbs)
{
    $breadcrumbs->parent('loan-repayments-deposit-accounts');
    $breadcrumbs->push('Create Loan Repayments Deposit Account', route('loan-repayments-deposit-accounts.create'));
});

// Home > Loan Repayments Deposit Account > Show Loan Repayments Deposit Account
Breadcrumbs::register('loan-repayments-deposit-accounts.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('loan-repayments-deposit-accounts');
    $breadcrumbs->push("Showing Account - " . $id, route('loan-repayments-deposit-accounts.show', $id));
});

// Home > Loan Repayments Deposit Account > Edit Loan Repayments Deposit Account
Breadcrumbs::register('loan-repayments-deposit-accounts.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('loan-repayments-deposit-accounts');
    $breadcrumbs->push("Edit Loan Repayments Deposit Account - " . $id, route('loan-repayments-deposit-accounts.edit', $id));
});

/******** END LOAN REPAYMENTS DEPOSIT ACCOUNTS ROUTES ********/



/******** USSD REGISTRATION ROUTES ********/

// Home > USSD Registration
Breadcrumbs::register('ussd-registration', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('USSD Registration', route('ussd-registration.index'));
});

// Home > USSD Registration > Create USSD Registration
Breadcrumbs::register('ussd-registration.create', function($breadcrumbs)
{
    $breadcrumbs->parent('ussd-registration');
    $breadcrumbs->push('Create USSD Registration', route('ussd-registration.create'));
});

// Home > USSD Registration > Show USSD Registration
Breadcrumbs::register('ussd-registration.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-registration');
    $breadcrumbs->push("Showing USSD Registration - " . $id, route('ussd-registration.show', $id));
});

// Home > USSD Registration > Edit USSD Registration
Breadcrumbs::register('ussd-registration.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-registration');
    $breadcrumbs->push("Edit USSD Registration - " . $id, route('ussd-registration.edit', $id));
});

/******** END USSD REGISTRATION ROUTES ********/



/******** USSD EVENTS ROUTES ********/

// Home > USSD Event
Breadcrumbs::register('ussd-events', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('USSD Events', route('ussd-events.index'));
});

// Home > USSD Event > Create USSD Event
Breadcrumbs::register('ussd-events.create', function($breadcrumbs)
{
    $breadcrumbs->parent('ussd-events');
    $breadcrumbs->push('Create USSD Event', route('ussd-events.create'));
});

// Home > USSD Event > Show USSD Event
Breadcrumbs::register('ussd-events.show', function($breadcrumbs, $id)
{
    //get event name
    $event_data = UssdEvent::find($id);
    $event_name = $event_data->name;
    $breadcrumbs->parent('ussd-events');
    $breadcrumbs->push("Showing USSD Event - " . $id . " - " . $event_name, route('ussd-events.show', $id));
});

// Home > USSD Event > Edit USSD Event
Breadcrumbs::register('ussd-events.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-events');
    $breadcrumbs->push("Edit USSD Event - " . $id, route('ussd-events.edit', $id));
});

/******** END USSD EVENTS ROUTES ********/



/******** USSD PAYMENTS ROUTES ********/

// Home > USSD Payment
Breadcrumbs::register('ussd-payments', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('USSD Payments', route('ussd-payments.index'));
});

// Home > USSD Payment > Create USSD Payment
Breadcrumbs::register('ussd-payments.create', function($breadcrumbs)
{
    $breadcrumbs->parent('ussd-payments');
    $breadcrumbs->push('Create USSD Payment', route('ussd-payments.create'));
});

// Home > USSD Payment > Show USSD Payment
Breadcrumbs::register('ussd-payments.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-payments');
    $breadcrumbs->push("Showing USSD Payment - " . $id, route('ussd-payments.show', $id));
});

// Home > USSD Payment > Edit USSD Payment
Breadcrumbs::register('ussd-payments.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-payments');
    $breadcrumbs->push("Edit USSD Payment - " . $id, route('ussd-payments.edit', $id));
});

/******** END USSD PAYMENTS ROUTES ********/



/******** USSD RECOMMENDS ROUTES ********/

// Home > USSD Recommend
Breadcrumbs::register('ussd-recommends', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('USSD Recommends', route('ussd-recommends.index'));
});

// Home > USSD Recommend > Create USSD Recommend
Breadcrumbs::register('ussd-recommends.create', function($breadcrumbs)
{
    $breadcrumbs->parent('ussd-recommends');
    $breadcrumbs->push('Create USSD Recommend', route('ussd-recommends.create'));
});

// Home > USSD Recommend > Show USSD Recommend
Breadcrumbs::register('ussd-recommends.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-recommends');
    $breadcrumbs->push("Showing USSD Recommend - " . $id, route('ussd-recommends.show', $id));
});

// Home > USSD Recommend > Edit USSD Recommend
Breadcrumbs::register('ussd-recommends.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-recommends');
    $breadcrumbs->push("Edit USSD Recommend - " . $id, route('ussd-recommends.edit', $id));
});

/******** END USSD RECOMMENDS ROUTES ********/



/******** USSD CONTACTUS ROUTES ********/

// Home > USSD Contact Us
Breadcrumbs::register('ussd-contactus', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('USSD Contact Us', route('ussd-contactus.index'));
});

// Home > USSD Contact Us > Create USSD Contact Us
Breadcrumbs::register('ussd-contactus.create', function($breadcrumbs)
{
    $breadcrumbs->parent('ussd-contactus');
    $breadcrumbs->push('Create USSD Contact Us', route('ussd-contactus.create'));
});

// Home > USSD Contact Us > Show USSD Contact Us
Breadcrumbs::register('ussd-contactus.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-contactus');
    $breadcrumbs->push("Showing USSD Contact Us - " . $id, route('ussd-contactus.show', $id));
});

// Home > USSD Contact Us > Edit USSD Contact Us
Breadcrumbs::register('ussd-contactus.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('ussd-contactus');
    $breadcrumbs->push("Edit USSD Contact Us - " . $id, route('ussd-contactus.edit', $id));
});

/******** END USSD CONTACTUS ROUTES ********/




/******** PERMISSIONS ROUTES ********/

// Home > Permissions
Breadcrumbs::register('permissions', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Permissions', route('permissions.index'));
});

// Home > Permissions > Create New Permission
Breadcrumbs::register('permissions.create', function($breadcrumbs)
{
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push('Create New Permission', route('permissions.create'));
});

// Home > Permissions > Show Permission
Breadcrumbs::register('permissions.show', function($breadcrumbs, $id)
{
    $permission = Permission::findOrFail($id);
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push($permission->display_name, route('permissions.show', $permission->id));
});

// Home > Permissions > Edit Permission
Breadcrumbs::register('permissions.edit', function($breadcrumbs, $id)
{
    $permission = Permission::findOrFail($id);
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push("Edit permission - " . $permission->display_name, route('permissions.edit', $permission->id));
});

/******** END PERMISSIONS ROUTES ********/


/******** ROLES ROUTES ********/

// Home > Roles
Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('roles', route('roles.index'));
});

// Home > Roles > Create New Role
Breadcrumbs::register('roles.create', function($breadcrumbs)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push('Create New Role', route('roles.create'));
});

// Home > Roles > Show Role
Breadcrumbs::register('roles.show', function($breadcrumbs, $id)
{
    $role = Role::findOrFail($id);
    $breadcrumbs->parent('roles');
    $breadcrumbs->push($role->display_name, route('roles.show', $role->id));
});

// Home > Roles > Edit Role
Breadcrumbs::register('roles.edit', function($breadcrumbs, $id)
{
    $role = Role::findOrFail($id);
    $breadcrumbs->parent('roles');
    $breadcrumbs->push("Edit role - " . $role->display_name, route('roles.edit', $role->id));
});

/******** END ROLES ROUTES ********/



/******** USERS ROUTES ********/

// Home > Users
Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Users', route('users.index'));
});

// Home > Users > Create New User
Breadcrumbs::register('users.create', function($breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Create New User', route('users.create'));
});

// Home > Users > Create Bulk User Accounts
Breadcrumbs::register('bulk-users.create', function($breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Create Bulk User Accounts', route('bulk-users.create'));
});

// Home > Users > Show User
Breadcrumbs::register('users.show', function($breadcrumbs, $id)
{
    $user = User::findOrFail($id);
    $full_names = $user->first_name . ' ' . $user->last_name;
    $breadcrumbs->parent('users');
    $breadcrumbs->push($full_names, route('users.show', $user->id));
});

// Home > Users > Edit User
Breadcrumbs::register('users.edit', function($breadcrumbs, $id)
{
    $user = User::findOrFail($id);
    $full_names = $user->first_name . ' ' . $user->last_name;
    $breadcrumbs->parent('users');
    $breadcrumbs->push("Edit user - " . $full_names, route('users.edit', $user->id));
});


/******** END USERS ROUTES ********/


/******** USER LOGIN ROUTES ********/

// Home > User Login
Breadcrumbs::register('user-logins', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User Logins', route('user-logins.index'));
});

// Home > User Login > Create User Login
Breadcrumbs::register('user-logins.create', function($breadcrumbs)
{
    $breadcrumbs->parent('user-logins');
    $breadcrumbs->push('Create User Login', route('user-logins.create'));
});

// Home > User Login > Show User Login
Breadcrumbs::register('user-logins.show', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('user-logins');
    $breadcrumbs->push("Showing User Login - " . $id, route('user-logins.show', $id));
});

// Home > User Login > Edit User Login
Breadcrumbs::register('user-logins.edit', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('user-logins');
    $breadcrumbs->push("Edit User Login - " . $id, route('user-logins.edit', $id));
});

/******** END USER LOGIN ROUTES ********/


