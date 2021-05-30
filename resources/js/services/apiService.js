/**
 * Возвращает морфологию слова.
 * @param word - слово
 * @returns {Promise<*>}
 */
export function loadingWordFormsOfWord(word) {
  return axios.get('/api/words/' + word)
    .then(response => response.data[0])
    .catch(() => null);
}

/**
 * Возвращает все слова, у которых нет пробелов и цифр.
 * @param searchWord - искомое слово.
 * @returns {Promise<AxiosResponse<any>>}
 */
export function getAllWords(searchWord = '') {
  return axios.get('/api/allWords', {
    params: {
      search: searchWord
    }
  }).then(response => {
    const regEx = /^[а-яА-ЯёЁ]+$/u;
    return response.data.filter(word => regEx.test(word.word) === true);
  });
}
