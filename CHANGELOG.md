# Changelog

All notable changes to `laravel-blade-crawler-detect` will be documented in this file.

## Unreleased

### Breaking

- Drop Laravel 9 support (EOL since Feb 2024). The package now targets Laravel 10, 11, 12, and 13.

### Added

- Laravel 13 support.
- `orchestra/testbench` declared as a dev dependency; Pest updated to support v2/v3/v4.
- Real test coverage for the `@user` directive (browser, Googlebot, Chrome-Lighthouse, missing UA, oversized UA, `@unlessuser`).

### Changed

- Read the user agent from the current request inside the `@user` closure instead of capturing it once at boot time — fixes a bug under long-running workers (Octane/Swoole) where every request saw the first caller's UA.
- `CrawlerDetect` singleton is now bound by class name with the legacy `'CrawlerDetect'` string as an alias, so `app(CrawlerDetect::class)` actually reuses the singleton.
- `phpunit.xml.dist` migrated to the PHPUnit 10+ schema.

### Removed

- `spatie/invade` dependency (no longer needed — the user agent is read directly from the request).

### Security

- Clamp the user-agent header to 2048 characters before running the crawler regex to defend against ReDoS on pathological input.
- Bump `dependabot/fetch-metadata` to v2, `actions/checkout` to v4, and `stefanzweifel/git-auto-commit-action` to v5.
- Tighten `update-changelog.yml` with least-privilege token permissions.

## v0.4.0 - 2025-10-01

Add Laravel 12 support

## v0.3.0 - 2023-04-19

Laravel 10

## v0.2.0 - 2022-08-19

- Add Lighthouse as ignored
- **Full Changelog**: https://github.com/vlados/laravel-blade-crawler-detect/compare/v0.1.0...v0.2.0
