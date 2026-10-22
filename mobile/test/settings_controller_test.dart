import 'package:charghat_blood_mobile/features/settings/presentation/settings_controller.dart';
import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';

void main() {
  test('settings controller updates theme and locale', () {
    final controller = SettingsController();

    controller.setThemeMode(ThemeMode.dark);
    controller.setLocale(const Locale('bn'));

    expect(controller.themeMode, ThemeMode.dark);
    expect(controller.locale.languageCode, 'bn');
  });
}
