import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../../core/utils/validators.dart';
import '../../../core/widgets/global_loading_overlay.dart';
import '../data/auth_controller.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final _formKey = GlobalKey<FormState>();
  final _emailCtrl = TextEditingController();
  final _passwordCtrl = TextEditingController();

  @override
  Widget build(BuildContext context) {
    final auth = context.watch<AuthController>();
    return Scaffold(
      appBar: AppBar(title: const Text('Login')),
      body: GlobalLoadingOverlay(
        isLoading: auth.isBusy,
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Form(
            key: _formKey,
            child: Column(
              children: [
                TextFormField(controller: _emailCtrl, validator: Validators.email, decoration: const InputDecoration(labelText: 'Email')),
                TextFormField(controller: _passwordCtrl, obscureText: true, validator: Validators.password, decoration: const InputDecoration(labelText: 'Password')),
                const SizedBox(height: 16),
                if (auth.error != null) Text(auth.error!, style: const TextStyle(color: Colors.red)),
                FilledButton(
                  onPressed: () async {
                    if (!_formKey.currentState!.validate()) return;
                    await auth.login(_emailCtrl.text, _passwordCtrl.text);
                  },
                  child: const Text('Login'),
                ),
                TextButton(onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const RegisterScreen())), child: const Text('Create account')),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class RegisterScreen extends StatefulWidget {
  const RegisterScreen({super.key});

  @override
  State<RegisterScreen> createState() => _RegisterScreenState();
}

class _RegisterScreenState extends State<RegisterScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nameCtrl = TextEditingController();
  final _phoneCtrl = TextEditingController();
  final _emailCtrl = TextEditingController();
  final _passwordCtrl = TextEditingController();
  final _codeCtrl = TextEditingController();
  String _bloodGroup = 'A+';
  String _upazila = 'Charghat';

  @override
  Widget build(BuildContext context) {
    final auth = context.watch<AuthController>();
    return Scaffold(
      appBar: AppBar(title: const Text('Register')),
      body: GlobalLoadingOverlay(
        isLoading: auth.isBusy,
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(16),
          child: Form(
            key: _formKey,
            child: Column(
              children: [
                TextFormField(controller: _nameCtrl, validator: (v) => Validators.required(v, 'Name'), decoration: const InputDecoration(labelText: 'Name')),
                TextFormField(controller: _phoneCtrl, validator: (v) => Validators.required(v, 'Phone'), decoration: const InputDecoration(labelText: 'Phone')),
                TextFormField(controller: _emailCtrl, validator: Validators.email, decoration: const InputDecoration(labelText: 'Email')),
                DropdownButtonFormField(value: _bloodGroup, items: const ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'].map((e) => DropdownMenuItem(value: e, child: Text(e))).toList(), onChanged: (v) => setState(() => _bloodGroup = v as String), decoration: const InputDecoration(labelText: 'Blood Group')),
                DropdownButtonFormField(value: _upazila, items: const ['Charghat', 'Puthia', 'Bagha'].map((e) => DropdownMenuItem(value: e, child: Text(e))).toList(), onChanged: (v) => setState(() => _upazila = v as String), decoration: const InputDecoration(labelText: 'Upazila')),
                TextFormField(controller: _passwordCtrl, obscureText: true, validator: Validators.password, decoration: const InputDecoration(labelText: 'Password')),
                TextFormField(controller: _codeCtrl, validator: (v) => Validators.required(v, 'Verification code'), decoration: const InputDecoration(labelText: 'Email verification code')),
                const SizedBox(height: 16),
                if (auth.error != null) Text(auth.error!, style: const TextStyle(color: Colors.red)),
                FilledButton(
                  onPressed: () async {
                    if (!_formKey.currentState!.validate()) return;
                    await auth.registerWithVerification({
                      'name': _nameCtrl.text,
                      'phone': _phoneCtrl.text,
                      'email': _emailCtrl.text,
                      'blood_group': _bloodGroup,
                      'upazila': _upazila,
                      'password': _passwordCtrl.text,
                      'code': _codeCtrl.text,
                    });
                    if (auth.isAuthenticated && context.mounted) Navigator.pop(context);
                  },
                  child: const Text('Register'),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
