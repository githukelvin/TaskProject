const ID_TOKEN_KEY = 'id_token' as string;

//get from localstorage

export const getToken = ():string => {
  return window.localStorage.getItem(ID_TOKEN_KEY)
}

//save

export const saveToken = (token:string) => {
   window.localStorage.setItem(ID_TOKEN_KEY,token)
}

//destroy token

export const destroyToken = () => {
    window.localStorage.removeItem(ID_TOKEN_KEY)
}


export default {getToken,saveToken,destroyToken}