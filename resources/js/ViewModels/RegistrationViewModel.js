export default class RegistrationViewModel {
    /**
     * @type {[*]}
     */
    errors = [
        {id: 'name_required', message: 'Псевдоним пользователя не может быть пустым', visible: ko.observable(false)},

        {id: 'email', message: 'E-mail не похож на настоящий', visible: ko.observable(false)},
        {id: 'email_required', message: 'E-mail не может быть пустым', visible: ko.observable(false)},

        {id: 'repeat', message: 'Пароли не совпадают', visible: ko.observable(false)},
        {id: 'password_required', message: 'Пароль не может быть пустым', visible: ko.observable(false)},
    ];

    /**
     * @type {KnockoutObservable<T>}
     */
    passwordVisible = ko.observable(false);

    /**
     * @type {KnockoutObservable<T>}
     */
    name = ko.observable('');

    /**
     * @type {KnockoutObservable<T>}
     */
    email = ko.observable('');

    /**
     * @type {{original: KnockoutObservable<T>, repeat: KnockoutObservable<T>, matched: KnockoutObservable<T>}}
     */
    password = {
        original: ko.observable(''),
        repeat: ko.observable('')
    };

    constructor() {
        this.name.subscribe(e => {
            this._validate('name_required', (this.name() || '').toString().length > 0);
        });

        this.email.subscribe(e => {
            let email = (this.email() || '').toString();

            this._validate('email_required', email.length > 0);

            if (email.length > 0) {
                this._validate('email', email.match(/^.+@.+\..{2,}$/));
            }
        });

        this.password.original.subscribe(e => {
            let password = (this.password.original() || '').toString();

            this._validate('password_required', password.length > 0);
            this._passwordCompare();
        });

        this.password.repeat.subscribe(e => {
            let password = (this.password.repeat() || '').toString();

            this._validate('password_required', password.length > 0);
            this._passwordCompare();
        });
    }

    togglePasswordVisibility() {
        this.passwordVisible(!this.passwordVisible());

        return false;
    }

    /**
     * @param key
     * @param status
     * @private
     */
    _validate(key, status) {
        for (let error of this.errors) {
            if (error.id === key) {
                error.visible(!status);
            }
        }
    }

    /**
     * @private
     */
    _passwordCompare() {
        if (this.password.original() && this.password.repeat()) {
            this._validate('repeat', this.password.original() === this.password.repeat());
        }
    }


    register() {
        for (let field of [this.password.original, this.password.repeat, this.email, this.name]) {
            field.notifySubscribers();
        }

        for (let error of this.errors) {
            if (error.visible()) {
                document.location = '#';
                return false;
            }
        }

        return true;
    }
}