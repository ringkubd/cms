<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Analytics extends Model
{
  function initializeAnalytics()
  {
    $KEY_FILE_LOCATION = File::get(storage_path('app/google-api/isdb-bisew-ef808e24332f.json'));

    $client = new Google_Client();
    $client->setAuthConfig($KEY_FILE_LOCATION);
    $client->addScope(\Google_Service_Analytics::ANALYTICS);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    return new Google_Service_Analytics($client);
  }

  function getFirstProfileId($analytics) {
    $accounts = $analytics->management_accounts->listManagementAccounts();
    if (count($accounts->getItems()) > 0) {
      $items = $accounts->getItems();
      $firstAccountId = $items[0]->getId();

      $properties = $analytics->management_webproperties
        ->listManagementWebproperties($firstAccountId);

      if (count($properties->getItems()) > 0) {
        $items = $properties->getItems();
        $firstPropertyId = $items[0]->getId();

        $profiles = $analytics->management_profiles
          ->listManagementProfiles($firstAccountId, $firstPropertyId);

        if (count($profiles->getItems()) > 0) {
          $items = $profiles->getItems();
          return $items[0]->getId();

        } else {
          throw new Exception('No views (profiles) found for this user.');
        }
      } else {
        throw new Exception('No properties found for this user.');
      }
    } else {
      throw new Exception('No accounts found for this user.');
    }
  }

  function getResults($analytics, $profileId) {
    return $analytics->data_ga->get(
      'ga:' . $profileId,
      '7daysAgo',
      'today',
      'ga:sessions');
  }

  function printResults($results) {
    // Parses the response from the Core Reporting API and prints
    // the profile name and total sessions.
    if (count($results->getRows()) > 0) {

      // Get the profile name.
      $profileName = $results->getProfileInfo()->getProfileName();

      // Get the entry for the first entry in the first row.
      $rows = $results->getRows();
      $sessions = $rows[0][0];

      // Print the results.
      print "First view (profile) found: $profileName\n";
      print "Total sessions: $sessions\n";
    } else {
      print "No results found.\n";
    }
  }
}
