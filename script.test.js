import { togglePasswordVisibility } from './path-to/pass-show-hide';

describe('togglePasswordVisibility', () => {
  let pswrdFieldMock;
  let toggleIconMock;

  beforeEach(() => {
    pswrdFieldMock = document.createElement('input');
    toggleIconMock = document.createElement('i');

    document.querySelector = jest.fn(selector => {
      if (selector === ".form input[type='password']") {
        return pswrdFieldMock;
      } else if (selector === ".form .field i") {
        return toggleIconMock;
      }
    });
  });

  test('should toggle password visibility', () => {
    togglePasswordVisibility();
    expect(pswrdFieldMock.type).toBe('text');
    expect(toggleIconMock.classList.contains('active')).toBe(true);
    togglePasswordVisibility();
    expect(pswrdFieldMock.type).toBe('password');
    expect(toggleIconMock.classList.contains('active')).toBe(false);
  });
});

