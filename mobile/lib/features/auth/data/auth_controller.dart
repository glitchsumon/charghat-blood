import 'package:flutter/foundation.dart';

class AuthController extends ChangeNotifier {
  bool _isAuthenticated = false;
  bool _isBusy = false;
  String? _error;

  bool get isAuthenticated => _isAuthenticated;
  bool get isBusy => _isBusy;
  String? get error => _error;

  Future<void> login(String email, String password) async {
    _isBusy = true;
    _error = null;
    notifyListeners();
    await Future<void>.delayed(const Duration(milliseconds: 350));
    if (email.isNotEmpty && password.length >= 8) {
      _isAuthenticated = true;
    } else {
      _error = 'Invalid credentials';
    }
    _isBusy = false;
    notifyListeners();
  }

  Future<void> registerWithVerification(Map<String, String> form) async {
    _isBusy = true;
    _error = null;
    notifyListeners();
    await Future<void>.delayed(const Duration(milliseconds: 350));
    final code = form['code'];
    if (code == '123456') {
      _isAuthenticated = true;
    } else {
      _error = 'Invalid verification code';
    }
    _isBusy = false;
    notifyListeners();
  }

  void logout() {
    _isAuthenticated = false;
    notifyListeners();
  }
}
