import 'package:flutter/material.dart';

import '../models/donor.dart';
import 'donor_card.dart';

class DonorsScreen extends StatefulWidget {
  const DonorsScreen({super.key});

  @override
  State<DonorsScreen> createState() => _DonorsScreenState();
}

class _DonorsScreenState extends State<DonorsScreen> {
  String _group = 'All';
  String _upazila = 'All';

  final _donors = const [
    Donor(id: 1, name: 'Rahim Uddin', bloodGroup: 'A+', address: 'Charghat', phone: '01700000000', available: true, daysSinceDonation: 120),
    Donor(id: 2, name: 'Sumaiya Khatun', bloodGroup: 'O-', address: 'Bagha', phone: '01800000000', available: false, daysSinceDonation: 22),
  ];

  @override
  Widget build(BuildContext context) {
    final filtered = _donors.where((d) => (_group == 'All' || d.bloodGroup == _group) && (_upazila == 'All' || d.address == _upazila)).toList();
    return Scaffold(
      body: ListView(
        padding: const EdgeInsets.all(16),
        children: [
          Row(
            children: [
              Expanded(
                child: DropdownButtonFormField<String>(
                  value: _group,
                  onChanged: (value) => setState(() => _group = value ?? 'All'),
                  items: const ['All', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']
                      .map((e) => DropdownMenuItem(value: e, child: Text(e)))
                      .toList(),
                  decoration: const InputDecoration(labelText: 'Blood Group'),
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: DropdownButtonFormField<String>(
                  value: _upazila,
                  onChanged: (value) => setState(() => _upazila = value ?? 'All'),
                  items: const ['All', 'Charghat', 'Bagha', 'Puthia'].map((e) => DropdownMenuItem(value: e, child: Text(e))).toList(),
                  decoration: const InputDecoration(labelText: 'Upazila'),
                ),
              ),
            ],
          ),
          const SizedBox(height: 8),
          ...filtered.map((donor) => DonorCard(donor: donor)),
        ],
      ),
    );
  }
}
