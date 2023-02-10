import{T as o}from"./TableView.6dc10ba1.js";import{e as C,m as T,r as n,a3 as v,z as P,c as R,am as A,j as s,F as L,h as i,C as S,ab as j,an as y,af as _,a as k}from"./index.7b0c7ee9.js";const D=()=>{const c=C(),{t:l}=T(),[d,f]=n.exports.useState(1),a=v(),r=P("users"),{data:e,isLoading:p,isError:g,refetch:h}=R("users",{params:{page:d}}),m=n.exports.useMemo(()=>{if(!e)return!1;const{data:t,...N}=e;return N},[e]),x=n.exports.useMemo(()=>e!=null&&e.data?e.data.filter(t=>t.id!==(a==null?void 0:a.id)):[],[e,a]),u=a==null?void 0:a.can({action:"update",targetModel:"users"}),E=()=>c("/users/invite"),M=u?t=>c(`/users/${t}`):void 0,b=u?async t=>{confirm(l(_.ON_DELETE_REQUEST_PROMPT))&&(await k.entries.delete("users",t),h())}:void 0,w=n.exports.useMemo(()=>{if(!!r)return A(r)},[r]);return s(L,{children:i(S,{children:[i("div",{className:"flex w-full flex-col justify-between gap-5 py-10 md:flex-row",children:[s("h1",{className:"text-3xl font-semibold capitalize",children:l("Users")}),s("div",{className:"flex items-center gap-5",children:i(j,{color:"green",className:" items-center font-semibold uppercase",size:"md",onClick:E,children:[s("span",{className:"hidden md:block",children:l("Add new user")}),s(y,{className:"inline-block h-5 w-5 md:ml-3"})," "]})})]}),s(o,{isLoading:p||g,items:x,columns:w||[],onEditAction:M,onDeleteAction:b}),i(o.Footer,{children:[m&&s(o.Metadata,{...m}),s(o.Pagination,{className:"ml-auto",total:(e==null?void 0:e.last_page)||1,page:d,onChange:f})]})]})})};export{D as default};
