import 'package:charghat_blood_mobile/core/utils/validators.dart';
import 'package:flutter_test/flutter_test.dart';

void main() {
  group('Validators', () {
    test('email validator rejects invalid email', () {
      expect(Validators.email('invalid'), isNotNull);
    });

    test('password validator enforces minimum length', () {
      expect(Validators.password('1234567'), isNotNull);
      expect(Validators.password('12345678'), isNull);
    });
  });
}
