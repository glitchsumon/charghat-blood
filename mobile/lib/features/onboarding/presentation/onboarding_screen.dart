import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';

class OnboardingScreen extends StatelessWidget {
  const OnboardingScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(24),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const Spacer(),
              Text('CharghatBlood', style: Theme.of(context).textTheme.headlineMedium),
              const SizedBox(height: 8),
              const Text('Find donors fast, respond to emergencies, and save lives together.'),
              const Spacer(),
              FilledButton(onPressed: () => context.go('/login'), child: const Text('Get Started')),
            ],
          ),
        ),
      ),
    );
  }
}
