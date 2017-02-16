export default class LoginViewModel {
    email = ko.observable('')
        .extend({
            required: true,
            pattern: {
                message: 'E-mail не похож на настоящий',
                params: '^.+@.+\..{2,}$'
            }
        });
}