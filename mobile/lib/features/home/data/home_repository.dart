import '../../donors/models/donor.dart';
import '../../emergency/models/emergency_request.dart';

class HomeRepository {
  List<String> banners() => [
        'Welcome to CharghatBlood',
        'Donate blood, save lives',
      ];

  List<Donor> topDonors() => const [
        Donor(id: 1, name: 'Rahim Uddin', bloodGroup: 'A+', address: 'Charghat, Rajshahi', phone: '01700000000', available: true, daysSinceDonation: 120),
      ];

  List<EmergencyRequest> emergencies() => [
        EmergencyRequest(
          id: 1,
          patientName: 'Sadia Akter',
          bloodGroup: 'O-',
          hospital: 'Charghat Upazila Health Complex',
          phone: '01800000000',
          neededAt: DateTime.now().add(const Duration(hours: 6)),
          bags: 2,
        ),
      ];
}
