CHANGELOG
=========

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## 0.6.0 - 2017-09-28
### Fixed
- Missing factory instances in some of the SMS entity constructors

### Removed
- Guzzle is no longer needed for the library.
- Duplicated license/help information in the example bootstrap is removed

## 0.5.0 - 2017-07-05
### Fixed
- Fixing backup code uri for create statement
- Adding factory for creating NumberLookup object
- urlencode some url parts

### Removed
- Removed validity as option for widget sessions

## 0.4.1 - 2017-06-22
### Fixed
- Create detailed ClientException when a wallet has insufficient credit

## 0.4.0 - 2017-06-14
### Added
- Function to retrieve balance

## 0.3.0 - 2017-06-13
### Added
- Added backup codes support
- Added support for embedded entity/collection

### Changed
- WidgetSession now has 'allowedTypes' as mandatory field. Recipient & BackupCodeIdentifier are optional.
- WidgetSession gained new fields 'verification' & 'verificationIds'
- WidgetSession uri has been changed

### Fixed
- Add missing fields to validation exception constructor

## 0.2.0 - 2017-04-26
### Added
- Added Widget Api functionality.
- Added the following fields to numberlookup entity; valid until, created date time, is roaming, is ported;
- Added the following fields to verification entity; reason code, created date time.

### Changed
- Updated examples.

### Fixed
- Improved exception messages.
- Only accept recipient arrays for sms and numberlookup.

## 0.1.0 - 2017-03-02
### Added
- Initial version
