import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';

import '../../features/auth/presentation/login_screen.dart';
import '../../features/donors/presentation/donors_screen.dart';
import '../../features/emergency/presentation/emergency_screen.dart';
import '../../features/home/presentation/home_screen.dart';
import '../../features/messages/presentation/messages_screen.dart';
import '../../features/onboarding/presentation/onboarding_screen.dart';
import '../../features/onboarding/presentation/splash_screen.dart';
import '../../features/profile/presentation/profile_screen.dart';
import '../../features/settings/presentation/settings_screen.dart';

class AppRouter {
  static final config = GoRouter(
    initialLocation: '/splash',
    routes: [
      GoRoute(path: '/splash', builder: (_, __) => const SplashScreen()),
      GoRoute(path: '/onboarding', builder: (_, __) => const OnboardingScreen()),
      GoRoute(path: '/login', builder: (_, __) => const LoginScreen()),
      ShellRoute(
        builder: (_, __, child) => _MainShell(child: child),
        routes: [
          GoRoute(path: '/home', builder: (_, __) => const HomeScreen()),
          GoRoute(path: '/donors', builder: (_, __) => const DonorsScreen()),
          GoRoute(path: '/emergency', builder: (_, __) => const EmergencyScreen()),
          GoRoute(path: '/messages', builder: (_, __) => const MessagesScreen()),
          GoRoute(path: '/profile', builder: (_, __) => const ProfileScreen()),
        ],
      ),
      GoRoute(path: '/settings', builder: (_, __) => const SettingsScreen()),
    ],
  );
}

class _MainShell extends StatelessWidget {
  const _MainShell({required this.child});

  final Widget child;

  static const _items = [
    (label: 'Home', icon: Icons.home, route: '/home'),
    (label: 'Blood', icon: Icons.bloodtype, route: '/donors'),
    (label: 'Emergency', icon: Icons.emergency, route: '/emergency'),
    (label: 'Messages', icon: Icons.message, route: '/messages'),
    (label: 'Profile', icon: Icons.person, route: '/profile'),
  ];

  @override
  Widget build(BuildContext context) {
    final route = GoRouterState.of(context).uri.path;
    final currentIndex = _items.indexWhere((item) => route.startsWith(item.route));

    return Scaffold(
      body: child,
      bottomNavigationBar: NavigationBar(
        selectedIndex: currentIndex < 0 ? 0 : currentIndex,
        destinations: _items.map((item) => NavigationDestination(icon: Icon(item.icon), label: item.label)).toList(),
        onDestinationSelected: (index) => context.go(_items[index].route),
      ),
    );
  }
}
