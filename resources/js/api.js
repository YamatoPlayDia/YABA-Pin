import axios from 'axios';
import { handleError } from './functions.js';

// CRUDの基本的な関数を定義
export function getAll(endpoint) {
    return axios.get(`/api/${endpoint}`)
      .then(response => response.data ? response.data : undefined)
      .catch(handleError);
}

export function getOne(endpoint, id) {
    return axios.get(`/api/${endpoint}/${id}`)
      .then(response => response.data ? response.data : undefined)
      .catch(handleError);
}

export function create(endpoint, data) {
    return axios.post(`/api/${endpoint}`, data)
      .then(response => response.data ? response.data : undefined)
      .catch(handleError);
}

export function update(endpoint, id, data) {
    return axios.put(`/api/${endpoint}/${id}`, data)
      .then(response => response.data ? response.data : undefined)
      .catch(handleError);
}

export function remove(endpoint, id) {
    return axios.delete(`/api/${endpoint}/${id}`)
      .then(response => response.data ? response.data : undefined)
      .catch(handleError);
}

export function getOneFromData(endpoint, dataName, uniqueData) {
  return axios.get(`/api/${endpoint}/one/${dataName}/${uniqueData}`)
    .then(response => response.data ? response.data : undefined)
    .catch(handleError);
}

export function getMultiFromData(endpoint, dataName, Data) {
  return axios.get(`/api/${endpoint}/multi/${dataName}/${Data}`)
    .then(response => (response.data && response.data.length > 0) ? response.data : undefined)
    .catch(handleError);
}

export function getUserID() {
  return axios.get('/api/user', {
      headers: {
          'Authorization': `Bearer ${window.Laravel.apiToken}`,
      },
  })
  .then(response => response.data.id)
  .catch(handleError); // 既に定義されているエラーハンドリング関数を使用
}
