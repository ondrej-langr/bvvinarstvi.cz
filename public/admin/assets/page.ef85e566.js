import{r as u,e as q,R as V,aF as W,a4 as k,c as B,m as F,an as G,a9 as M,a as C,p as v,aG as Q,j as d,B as Y,h as y,C as H,ae as J,n as K}from"./index.ce9e6114.js";import{T as h}from"./TableView.2edc3557.js";var U=Object.defineProperty,X=Object.defineProperties,Z=Object.getOwnPropertyDescriptors,D=Object.getOwnPropertySymbols,$=Object.prototype.hasOwnProperty,ee=Object.prototype.propertyIsEnumerable,R=(c,n,a)=>n in c?U(c,n,{enumerable:!0,configurable:!0,writable:!0,value:a}):c[n]=a,te=(c,n)=>{for(var a in n||(n={}))$.call(n,a)&&R(c,a,n[a]);if(D)for(var a of D(n))ee.call(n,a)&&R(c,a,n[a]);return c},se=(c,n)=>X(c,Z(n));function ae(c=[]){const[n,a]=u.exports.useState(c);return[n,{setState:a,append:(...t)=>a(s=>[...s,...t]),prepend:(...t)=>a(s=>[...t,...s]),insert:(t,...s)=>a(i=>[...i.slice(0,t),...s,...i.slice(t)]),pop:()=>a(t=>{const s=[...t];return s.pop(),s}),shift:()=>a(t=>{const s=[...t];return s.shift(),s}),apply:t=>a(s=>s.map((i,r)=>t(i,r))),applyWhere:(t,s)=>a(i=>i.map((r,p)=>t(r,p)?s(r,p):r)),remove:(...t)=>a(s=>s.filter((i,r)=>!t.includes(r))),reorder:({from:t,to:s})=>a(i=>{const r=[...i],p=i[t];return r.splice(t,1),r.splice(s,0,p),r}),setItem:(t,s)=>a(i=>{const r=[...i];return r[t]=s,r}),setItemProp:(t,s,i)=>a(r=>{const p=[...r];return p[t]=se(te({},p[t]),{[s]:i}),p}),filter:t=>{a(s=>s.filter(t))}}]}const oe=({})=>{var O;const c=q(),{modelId:n}=V(),[a,_]=u.exports.useState(1),[P,w]=u.exports.useState(20),e=W(),m=k(),[E,x]=u.exports.useState(!1),{data:o,isLoading:S,isError:I,refetch:T}=B(e==null?void 0:e.name,{params:{page:a,limit:P,...e!=null&&e.hasTimestamps?{"orderBy.created_at":"desc"}:{}}}),{t:g}=F(),[t,s]=ae(o==null?void 0:o.data);u.exports.useEffect(()=>{o!=null&&o.data&&s.setState(o==null?void 0:o.data)},[o]);const i=u.exports.useMemo(()=>{if(!o)return!1;const{data:l,...f}=o;return f},[o]),r=async({source:l,destination:f})=>{if((f==null?void 0:f.index)===void 0)return;x(!0);const b=t[l.index].id,N=t[f.index].id;b!==N&&(s.reorder({from:l.index,to:f.index}),await C.entries.swap(e.name,{fromId:b,toId:N})),x(!1)},p=u.exports.useMemo(()=>{if(!!e)return G(e)},[e]),j=e&&(m==null?void 0:m.can({action:"delete",targetModel:e==null?void 0:e.name}))?async l=>{confirm(g(M.ON_DELETE_REQUEST_PROMPT))&&(await C.entries.delete(e.name,l),T())}:void 0,A=e&&(m==null?void 0:m.can({action:"create",targetModel:e==null?void 0:e.name}))?async l=>{confirm(g(M.ENTRY_ITEM_DUPLICATE))&&c(v.entryTypes(e==null?void 0:e.name).duplicate(l))}:void 0,L=()=>c(v.entryTypes(e==null?void 0:e.name).create),z=l=>c(v.entryTypes(e==null?void 0:e.name).view(l));return u.exports.useEffect(()=>_(1),[n]),!e||!p||Q(e.name)?d(Y,{text:g("This model with this id does not exist.")}):y(H,{children:[y("div",{className:"flex w-full flex-col justify-between gap-5 py-10 md:flex-row",children:[d("h1",{className:"text-3xl font-semibold capitalize",children:g((O=e.title)!=null?O:e.name)}),d("div",{className:"flex items-center gap-5",children:(m==null?void 0:m.can({action:"create",targetModel:e.name}))&&y(J,{color:"green",className:" items-center font-semibold uppercase",size:"md",onClick:L,children:[d("span",{className:"hidden md:block",children:g("Add new entry")}),d(K,{className:"inline-block h-5 w-5 md:ml-3"})," "]})})]}),d(h,{isLoading:S||I,items:t,columns:p,onEditAction:z,onDeleteAction:j,onDuplicateAction:A,ordering:!!e.hasOrdering,onDragEnd:r,disabled:E}),y(h.Footer,{children:[d(h.PageSizeSelect,{value:String(P),onChange:l=>{w(l?Number(l):20)}}),i&&d(h.Metadata,{className:"mr-auto ml-5",...i}),d(h.Pagination,{className:"ml-auto",total:(o==null?void 0:o.last_page)||1,page:a,onChange:_})]})]})};export{oe as default};