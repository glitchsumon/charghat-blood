import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';

class GlobalLoadingOverlay extends StatelessWidget {
  const GlobalLoadingOverlay({super.key, required this.child, required this.isLoading});

  final Widget child;
  final bool isLoading;

  @override
  Widget build(BuildContext context) {
    return Stack(
      children: [
        child,
        if (isLoading)
          ColoredBox(
            color: Colors.black38,
            child: Center(
              child: SizedBox(
                width: 120,
                height: 120,
                child: Lottie.asset(
                  'assets/animations/global_loading.json',
                  fit: BoxFit.contain,
                  errorBuilder: (_, __, ___) => const CircularProgressIndicator(),
                ),
              ),
            ),
          ),
      ],
    );
  }
}
