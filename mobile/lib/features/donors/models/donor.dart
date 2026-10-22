class Donor {
  const Donor({
    required this.id,
    required this.name,
    required this.bloodGroup,
    required this.address,
    required this.phone,
    required this.available,
    required this.daysSinceDonation,
    this.photoUrl,
  });

  final int id;
  final String name;
  final String bloodGroup;
  final String address;
  final String phone;
  final bool available;
  final int daysSinceDonation;
  final String? photoUrl;
}
