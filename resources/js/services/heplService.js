/**
 * Сравнивает присутствует ли элемент в массиве.
 * @param value
 * @param index
 * @param self
 * @returns {boolean}
 */
export function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
}
