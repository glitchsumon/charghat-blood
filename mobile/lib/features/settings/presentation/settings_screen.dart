import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'settings_controller.dart';

class SettingsScreen extends StatelessWidget {
  const SettingsScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final controller = context.watch<SettingsController>();
    return Scaffold(
      appBar: AppBar(title: const Text('Settings')),
      body: ListView(
        children: [
          ListTile(
            title: const Text('Theme'),
            subtitle: Text(controller.themeMode.name),
            trailing: DropdownButton<ThemeMode>(
              value: controller.themeMode,
              onChanged: (value) {
                if (value != null) controller.setThemeMode(value);
              },
              items: const [
                DropdownMenuItem(value: ThemeMode.system, child: Text('System')),
                DropdownMenuItem(value: ThemeMode.light, child: Text('Light')),
                DropdownMenuItem(value: ThemeMode.dark, child: Text('Dark')),
              ],
            ),
          ),
          ListTile(
            title: const Text('Language'),
            subtitle: Text(controller.locale.languageCode == 'bn' ? 'বাংলা' : 'English'),
            trailing: DropdownButton<Locale>(
              value: controller.locale,
              onChanged: (value) {
                if (value != null) controller.setLocale(value);
              },
              items: const [
                DropdownMenuItem(value: Locale('en'), child: Text('English')),
                DropdownMenuItem(value: Locale('bn'), child: Text('বাংলা')),
              ],
            ),
          ),
          const SwitchListTile(value: true, onChanged: null, title: Text('Emergency notifications')),
          const SwitchListTile(value: true, onChanged: null, title: Text('Donor match notifications')),
        ],
      ),
    );
  }
}
