import 'package:flutter/material.dart';

class MessagesScreen extends StatelessWidget {
  const MessagesScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Messages')),
      body: ListView(
        children: const [
          ListTile(
            leading: CircleAvatar(child: Icon(Icons.bloodtype)),
            title: Text('Donor chat with Rahim Uddin'),
            subtitle: Text('Can you donate tonight?'),
            trailing: Badge(label: Text('Donor')),
          ),
          ListTile(
            leading: CircleAvatar(child: Icon(Icons.emergency)),
            title: Text('Emergency response thread'),
            subtitle: Text('I can help with one bag.'),
            trailing: Badge(label: Text('Emergency')),
          ),
        ],
      ),
    );
  }
}
