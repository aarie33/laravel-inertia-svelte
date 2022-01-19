import route from 'ziggy';
import { Ziggy } from '../ziggy';

export function routes(name, param = undefined) {
  console.log(route(name, param, undefined, Ziggy));
  return route(name, param, undefined, Ziggy);
}
