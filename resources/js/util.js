export function validateUsername(username) {
  const pattern = /^[a-zA-Z0-9_-]{5,10}$/
  return pattern.test(username)
}

export function validatePassword(password) {
  const pattern = /^[a-zA-Z0-9]\w{5,17}$/
  return pattern.test(password)
}

export function validateEmail(email) {
  const pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
  return pattern.test(email)
}
