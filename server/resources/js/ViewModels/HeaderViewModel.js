import Dropdown from '../Support/Dropdown';

export default class HeaderViewModel {
    /**
     * @type {Dropdown}
     */
    resources = new Dropdown('resources-handler');

    /**
     * @type {Dropdown}
     */
    user = new Dropdown('user-handler');
}