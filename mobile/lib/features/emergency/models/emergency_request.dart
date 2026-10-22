class EmergencyRequest {
  const EmergencyRequest({
    required this.id,
    required this.patientName,
    required this.bloodGroup,
    required this.hospital,
    required this.phone,
    required this.neededAt,
    required this.bags,
  });

  final int id;
  final String patientName;
  final String bloodGroup;
  final String hospital;
  final String phone;
  final DateTime neededAt;
  final int bags;
}
