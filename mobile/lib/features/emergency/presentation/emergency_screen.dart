import 'package:flutter/material.dart';

class EmergencyScreen extends StatelessWidget {
  const EmergencyScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
          title: const Text('Emergency Requests'),
          bottom: const TabBar(tabs: [Tab(text: 'Others'), Tab(text: 'Yours')]),
        ),
        body: const TabBarView(
          children: [
            _EmergencyList(title: 'Other emergency requests'),
            _EmergencyList(title: 'Your emergency requests'),
          ],
        ),
        floatingActionButton: FloatingActionButton.extended(onPressed: () {}, icon: const Icon(Icons.add), label: const Text('Create Request')),
      ),
    );
  }
}

class _EmergencyList extends StatelessWidget {
  const _EmergencyList({required this.title});

  final String title;

  @override
  Widget build(BuildContext context) {
    return ListView(
      padding: const EdgeInsets.all(16),
      children: [
        Text(title, style: Theme.of(context).textTheme.titleMedium),
        const SizedBox(height: 8),
        const Card(
          child: ListTile(
            title: Text('Patient: Jannat • O+'),
            subtitle: Text('Hospital: Charghat Upazila Health Complex\nNeed: 2 bags'),
            isThreeLine: true,
            trailing: Row(mainAxisSize: MainAxisSize.min, children: [Icon(Icons.call), SizedBox(width: 8), Icon(Icons.message)]),
          ),
        ),
      ],
    );
  }
}
