import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'app/app.dart';
import 'features/auth/data/auth_controller.dart';
import 'features/settings/presentation/settings_controller.dart';

void main() {
  runApp(
    MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => SettingsController()),
        ChangeNotifierProvider(create: (_) => AuthController()),
      ],
      child: const CharghatBloodApp(),
    ),
  );
}
