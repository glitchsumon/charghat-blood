# Operations and Backup Guidance

## Safe Backup Strategy
- Use managed database snapshots (MySQL/PostgreSQL provider snapshots) where possible.
- Run scheduled encrypted dumps (`mysqldump`/`pg_dump`) to secure object storage.
- Store retention metadata (daily + weekly + monthly policies).
- Validate backup integrity by running periodic restore drills in staging.

## Restore Process (Recommended)
1. Put API in maintenance mode.
2. Restore database snapshot into a staging environment first.
3. Run verification checks on critical tables (`users`, `donor_profiles`, `emergency_requests`).
4. Restore to production only after verification.
5. Re-enable traffic and monitor health checks.

## Security Notes
- Never expose database or backup credentials in source control.
- Restrict backup and restore operations to privileged admin roles.
- Avoid arbitrary shell execution from user-controlled input.
- Keep file uploads validated by MIME type/size and scan before storage.
