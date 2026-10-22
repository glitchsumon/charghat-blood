import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../auth/data/auth_controller.dart';

class ProfileScreen extends StatelessWidget {
  const ProfileScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final auth = context.read<AuthController>();
    return Scaffold(
      appBar: AppBar(title: const Text('Profile')),
      drawer: const _AppDrawer(),
      body: ListView(
        padding: const EdgeInsets.all(16),
        children: [
          const ListTile(title: Text('Name'), subtitle: Text('Demo User')),
          const ListTile(title: Text('Email'), subtitle: Text('demo@charghatblood.test')),
          const ListTile(title: Text('Blood Group'), subtitle: Text('A+')),
          const ListTile(title: Text('Upazila'), subtitle: Text('Charghat')),
          FilledButton(onPressed: () {}, child: const Text('Edit Profile')),
          OutlinedButton(onPressed: auth.logout, child: const Text('Logout')),
        ],
      ),
    );
  }
}

class _AppDrawer extends StatelessWidget {
  const _AppDrawer();

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: ListView(
        children: const [
          DrawerHeader(child: Text('CharghatBlood')),
          ListTile(title: Text('Hospitals & Medicine')),
          ListTile(title: Text('Health Tips')),
          ListTile(title: Text('Become Donor')),
          ListTile(title: Text('Support Developer')),
          ListTile(title: Text('Share App')),
          ListTile(title: Text('Logout')),
        ],
      ),
    );
  }
}
