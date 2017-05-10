import { Annotation } from "dioma";


class Input {

}

export default function (args) {
    return new Annotation(args).delegate(Input);
}
