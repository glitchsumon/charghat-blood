import 'package:flutter/material.dart';

import '../models/donor.dart';

class DonorCard extends StatelessWidget {
  const DonorCard({super.key, required this.donor, this.onTap});

  final Donor donor;
  final VoidCallback? onTap;

  @override
  Widget build(BuildContext context) {
    return Card(
      child: ListTile(
        onTap: onTap,
        leading: CircleAvatar(child: Text(donor.bloodGroup)),
        title: Text(donor.name),
        subtitle: Text('${donor.address}\nLast donation: ${donor.daysSinceDonation} days ago'),
        isThreeLine: true,
        trailing: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Icon(donor.available ? Icons.check_circle : Icons.cancel, color: donor.available ? Colors.green : Colors.red),
            const SizedBox(height: 6),
            Row(mainAxisSize: MainAxisSize.min, children: const [Icon(Icons.call, size: 16), SizedBox(width: 6), Icon(Icons.message, size: 16)]),
          ],
        ),
      ),
    );
  }
}
