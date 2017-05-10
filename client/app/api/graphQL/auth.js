import gql from 'graphql-tag'

export const login = gql`
  query login($email: String!, $password: String!) {
    auth(email: $email, password: $password) {
      name
      avatar
      token
      is_confirmed
      email
    }
  }
`
