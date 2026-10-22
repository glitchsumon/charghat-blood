import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../core/l10n/app_localizations.dart';
import '../core/router/app_router.dart';
import '../core/theme/app_theme.dart';
import '../features/settings/presentation/settings_controller.dart';

class CharghatBloodApp extends StatelessWidget {
  const CharghatBloodApp({super.key});

  @override
  Widget build(BuildContext context) {
    final settings = context.watch<SettingsController>();

    return MaterialApp.router(
      title: 'CharghatBlood',
      debugShowCheckedModeBanner: false,
      routerConfig: AppRouter.config,
      theme: AppTheme.lightTheme,
      darkTheme: AppTheme.darkTheme,
      themeMode: settings.themeMode,
      locale: settings.locale,
      localizationsDelegates: AppLocalizations.delegates,
      supportedLocales: AppLocalizations.supportedLocales,
    );
  }
}
