export default class Errors {
    constructor() {
        this.errors = {};
    }
    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }
    record(errors) {
        this.errors = errors;
    }
    clear(field) {
        this.errors[field] = undefined;
    }
    clearAll() {
        this.errors = {};
    }
    static objectKeysToCamelCase(snake_case_object) {
        let camelCaseObject = {};
        _.forEach(
            snake_case_object,
            function (value, key) {
                if (_.isPlainObject(value) || _.isArray(value)) {
                    value = Errors.objectKeysToCamelCase(value);
                }
                camelCaseObject[_.camelCase(key)] = value;
            }
        );
        return camelCaseObject;
    }
}