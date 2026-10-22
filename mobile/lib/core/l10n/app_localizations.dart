import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_localizations/flutter_localizations.dart';

class AppLocalizations {
  AppLocalizations(this.locale);

  final Locale locale;

  static const supportedLocales = [Locale('en'), Locale('bn')];

  static const delegates = [
    _AppLocalizationsDelegate(),
    GlobalMaterialLocalizations.delegate,
    GlobalWidgetsLocalizations.delegate,
    GlobalCupertinoLocalizations.delegate,
  ];

  static AppLocalizations of(BuildContext context) {
    return Localizations.of<AppLocalizations>(context, AppLocalizations)!;
  }

  static const _values = {
    'en': {
      'appName': 'CharghatBlood',
      'home': 'Home',
      'donors': 'Donors',
      'emergency': 'Emergency',
      'messages': 'Messages',
      'profile': 'Profile',
      'login': 'Login',
      'register': 'Register',
      'searchDonor': 'Search Donor',
      'settings': 'Settings',
      'loading': 'Loading...',
    },
    'bn': {
      'appName': 'চারঘাট ব্লাড',
      'home': 'হোম',
      'donors': 'ডোনর',
      'emergency': 'জরুরি',
      'messages': 'মেসেজ',
      'profile': 'প্রোফাইল',
      'login': 'লগইন',
      'register': 'রেজিস্টার',
      'searchDonor': 'ডোনর খুঁজুন',
      'settings': 'সেটিংস',
      'loading': 'লোড হচ্ছে...',
    }
  };

  String t(String key) => _values[locale.languageCode]?[key] ?? _values['en']![key] ?? key;
}

class _AppLocalizationsDelegate extends LocalizationsDelegate<AppLocalizations> {
  const _AppLocalizationsDelegate();

  @override
  bool isSupported(Locale locale) => AppLocalizations.supportedLocales.any((l) => l.languageCode == locale.languageCode);

  @override
  Future<AppLocalizations> load(Locale locale) => SynchronousFuture(AppLocalizations(locale));

  @override
  bool shouldReload(covariant LocalizationsDelegate<AppLocalizations> old) => false;
}
