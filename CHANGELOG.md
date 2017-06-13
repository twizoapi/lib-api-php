CHANGELOG
=========

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).
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
