# CharghatBlood Monorepo Foundation

Production-oriented foundation for **CharghatBlood**:
- Flutter mobile app (`mobile/`)
- Laravel API/admin backend foundation (`backend/`)
- Admin domain reference: `cblood.cc.cd`

> This is a secure-by-default baseline with environment placeholders and mock/demo-capable flows. No production credentials are committed.

## Monorepo Layout

```text
.
├── mobile/                 # Flutter app shell (light/dark, EN/BN, navigation, feature modules)
├── backend/                # Laravel 12 API foundation and admin-ready domain model
├── docs/
│   ├── ADMIN_ROADMAP.md
│   └── OPERATIONS.md
└── .github/workflows/ci.yml
```

## Mobile (`mobile/`)

### Included foundation
- Professional app shell with Material 3 (non-neon palette)
- Light/dark themes and English/Bangla localization
- Splash screen with app-name-only animation (`CharghatBlood`)
- Onboarding entry screen
- Bottom navigation: Home, Blood/Donors, Emergency, Messages, Profile
- Global loading overlay with Lottie + safe spinner fallback
- Feature-first structure (`features/auth`, `features/donors`, etc.)
- Typed domain models (`Donor`, `EmergencyRequest`)
- API client abstraction and validation helpers
- Registration/login shell with email verification-code input flow
- Donor filter UI by blood group/upazila, donor list cards
- Emergency page with tabs (Others/Yours)
- Messages and settings skeletons (theme/language/notification controls)
- Drawer entries: hospitals/medicine, health tips, become donor, support developer, share app, logout

### Run locally
```bash
cd mobile
cp .env.example .env
flutter pub get
flutter run
```

### Mobile tests
```bash
cd mobile
flutter test
```

## Backend (`backend/`)

### Included foundation
- Laravel 12 API structure with versioned routes (`/api/v1`)
- Authentication endpoints + OTP-style email verification code service
- Sanctum token-based session design (dependency declared)
- Request validation + normalized API error format
- Rate limiting for auth/OTP flows
- Core entities modeled with migrations and Eloquent models:
  - users, blood_groups, upazilas
  - donor_profiles, donor_applications
  - emergency_requests, reviews
  - conversations, messages
  - banners/home content
  - health_tip_categories, health_tips
  - hospitals, medicines
  - notification_templates, app_settings
  - admin_actions, email_verification_codes
- Seeders for blood groups, upazilas, baseline app settings
- Notification abstraction (email + OneSignal drivers) and queue-friendly emergency notification job
- CORS and app-level config placeholders
- Feature tests for auth verification-code behavior and donor search filtering

### API surface (foundation)
- `POST /api/v1/auth/send-verification-code`
- `POST /api/v1/auth/register`
- `POST /api/v1/auth/login`
- `POST /api/v1/auth/logout` (auth)
- `GET/PATCH /api/v1/profile` (auth)
- `GET /api/v1/home`
- `GET /api/v1/donors`
- `GET /api/v1/donors/{donorProfile}`
- `POST /api/v1/donor-applications` (auth)
- `GET /api/v1/emergency-requests`
- `POST /api/v1/emergency-requests` (auth)
- `GET /api/v1/emergency-requests/{emergencyRequest}`
- `POST /api/v1/emergency-requests/{emergencyRequest}/respond` (auth)
- `GET /api/v1/conversations` (auth)
- `GET /api/v1/conversations/{conversation}` (auth)
- `POST /api/v1/conversations/{conversation}/messages` (auth)
- `GET /api/v1/directory/hospitals`
- `GET /api/v1/directory/medicines`
- `GET /api/v1/directory/health-tips`
- `GET /api/v1/settings`
- `GET /api/v1/notifications` (auth)
- `PATCH /api/v1/notification-preferences` (auth)

### Run locally
```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Backend tests
```bash
cd backend
php artisan test
```

## Environment Variables

### Mobile (`mobile/.env.example`)
- `APP_NAME`
- `API_BASE_URL`
- `ENABLE_DEMO_MODE`
- `ONESIGNAL_APP_ID`
- `SUPPORT_DEVELOPER_URL`
- `SHARE_APP_URL`

### Backend (`backend/.env.example`)
- App basics (`APP_NAME`, `APP_ENV`, `APP_URL`)
- Database (`DB_*`)
- Mail/SMTP (`MAIL_*`)
- CORS (`CORS_ALLOWED_ORIGINS`)
- Charghat settings (`HOME_CAROUSEL_INTERVAL`, `ADMIN_DOMAIN`)
- Notification integrations (`ONESIGNAL_APP_ID`, `ONESIGNAL_API_KEY`)

## CI
GitHub Actions (`.github/workflows/ci.yml`) runs:
- Backend: composer install, Pint check, tests
- Mobile: Flutter pub get, analyze, tests

## Production notes and remaining tasks
- Admin UI is intentionally not fully built yet. Use `docs/ADMIN_ROADMAP.md` for staged implementation.
- Replace demo/mock behaviors with real API wiring in mobile repositories/services.
- Configure real SMTP and OneSignal credentials via environment variables.
- Add infrastructure hardening (TLS, WAF, queue workers, observability, backups) before go-live.
- Follow `docs/OPERATIONS.md` for safe backup/restore workflow.

