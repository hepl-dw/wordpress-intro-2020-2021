import Pluton from 'whitecube-pluton';

class DwTest {

    constructor() {
        // TODO
    }

    load() {
        this.pluton = new Pluton();
    }

}

window.addEventListener('load', (e) => {
    window.DwTest = new DwTest();
    window.DwTest.load();
});