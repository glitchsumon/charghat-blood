import 'dart:async';

import 'package:flutter/material.dart';

import '../../donors/presentation/donor_card.dart';
import '../../emergency/models/emergency_request.dart';
import '../data/home_repository.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  final _repository = HomeRepository();
  late final PageController _pageController;
  Timer? _timer;

  @override
  void initState() {
    super.initState();
    _pageController = PageController();
    _timer = Timer.periodic(const Duration(seconds: 5), (_) {
      if (!_pageController.hasClients) return;
      final next = ((_pageController.page ?? 0).round() + 1) % _repository.banners().length;
      _pageController.animateToPage(next, duration: const Duration(milliseconds: 350), curve: Curves.easeInOut);
    });
  }

  @override
  void dispose() {
    _timer?.cancel();
    _pageController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final banners = _repository.banners();
    final topDonors = _repository.topDonors();
    final emergencies = _repository.emergencies();

    return ListView(
      padding: const EdgeInsets.all(16),
      children: [
        SizedBox(
          height: 140,
          child: PageView.builder(
            controller: _pageController,
            itemCount: banners.length,
            itemBuilder: (_, index) => Card(
              child: Center(child: Text(banners[index], style: Theme.of(context).textTheme.titleMedium)),
            ),
          ),
        ),
        const SizedBox(height: 16),
        Text('Top Donors', style: Theme.of(context).textTheme.titleMedium),
        ...topDonors.map((d) => DonorCard(donor: d)),
        const SizedBox(height: 16),
        Text('Emergency Requests', style: Theme.of(context).textTheme.titleMedium),
        ...emergencies.map(_EmergencyTile.new),
        const SizedBox(height: 16),
        Text('Health Tips', style: Theme.of(context).textTheme.titleMedium),
        const Card(child: ListTile(title: Text('Stay hydrated before donation'))),
      ],
    );
  }
}

class _EmergencyTile extends StatelessWidget {
  const _EmergencyTile(this.request);

  final EmergencyRequest request;

  @override
  Widget build(BuildContext context) {
    return Card(
      child: ListTile(
        title: Text('${request.patientName} • ${request.bloodGroup}'),
        subtitle: Text('${request.hospital}\nBags: ${request.bags}'),
        isThreeLine: true,
        trailing: Row(mainAxisSize: MainAxisSize.min, children: const [Icon(Icons.call), SizedBox(width: 8), Icon(Icons.message)]),
      ),
    );
  }
}
